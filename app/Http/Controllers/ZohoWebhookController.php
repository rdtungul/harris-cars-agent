<?php

namespace App\Http\Controllers;

use App\Models\ZohoFormSubmission;
use App\Models\Appointment;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ZohoWebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        // Verify the webhook secret header
        $incomingSecret = $request->header('X-Zoho-Webhook-Secret');
        $expectedSecret = config('zoho.webhook_secret');

        if (! empty($expectedSecret) && $incomingSecret !== $expectedSecret) {
            Log::warning('Zoho webhook: unauthorized request from ' . $request->ip());
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Log every submission
        $submission = ZohoFormSubmission::create([
            'form_name'         => $request->input('form_name', 'unknown'),
            'payload'           => $request->all(),
            'ip_address'        => $request->ip(),
            'processed_at'      => now(),
            'processing_status' => 'received',
        ]);

        try {
            // Route to appropriate handler based on form_name
            match ($request->input('form_name')) {
                config('zoho.form_names.appointment') => $this->createAppointment($request, $submission),
                config('zoho.form_names.review')      => $this->createTestimonial($request, $submission),
                default                               => null,
            };

            $submission->update(['processing_status' => 'processed']);

        } catch (\Exception $e) {
            Log::error('Zoho webhook processing error: ' . $e->getMessage(), [
                'submission_id' => $submission->id,
                'form_name'     => $request->input('form_name'),
            ]);

            $submission->update([
                'processing_status' => 'failed',
                'processing_notes'  => $e->getMessage(),
            ]);
        }

        return response()->json(['status' => 'ok', 'submission_id' => $submission->id]);
    }

    private function createAppointment(Request $request, ZohoFormSubmission $submission): void
    {
        Appointment::create([
            'customer_name'  => $request->input('Name', $request->input('name', '')),
            'email'          => $request->input('Email', $request->input('email', '')),
            'phone'          => $request->input('Phone', $request->input('phone', '')),
            'vehicle_make'   => $request->input('Vehicle_Make', $request->input('vehicle_make', '')),
            'vehicle_model'  => $request->input('Vehicle_Model', $request->input('vehicle_model', '')),
            'vehicle_year'   => $request->input('Vehicle_Year', $request->input('vehicle_year', '')),
            'preferred_date' => $request->input('Preferred_Date', $request->input('preferred_date')),
            'preferred_time' => $request->input('Preferred_Time', $request->input('preferred_time', '')),
            'notes'          => $request->input('Notes', $request->input('notes', '')),
            'source'         => 'zoho',
        ]);
    }

    private function createTestimonial(Request $request, ZohoFormSubmission $submission): void
    {
        Testimonial::create([
            'customer_name'     => $request->input('Name', $request->input('name', '')),
            'customer_location' => $request->input('Location', $request->input('location', '')),
            'rating'            => (int) $request->input('Rating', $request->input('rating', 5)),
            'review'            => $request->input('Review', $request->input('review', '')),
            'source'            => 'zoho',
            'is_approved'       => false,
        ]);
    }
}
