<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Dismissed Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9em;
        }
        .info-box {
            background-color: white;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin: 15px 0;
            border-radius: 3px;
        }
        .note-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
            border-radius: 3px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Report Review Complete</h2>
    </div>
    
    <div class="content">
        <p>Hello <strong>{{ $recipientName }}</strong>,</p>
        
        @if($recipientType === 'reporter')
            <p>Thank you for submitting a report to help keep our community safe. We have carefully reviewed your report.</p>
            
            <div class="info-box">
                <h4>Report Details:</h4>
                <p><strong>Report ID:</strong> #{{ $reportId }}</p>
                <p><strong>Reported Post:</strong> {{ $postTitle }}</p>
                <p><strong>Your Report Message:</strong> {{ $reportMessage }}</p>
            </div>
            
            <div class="note-box">
                <h4>Review Outcome:</h4>
                <p>After thorough review, our team has determined that the reported content does not currently violate our community guidelines. Therefore, this report has been <strong>dismissed</strong>.</p>
                @if($adminNotes && $adminNotes !== 'No additional notes provided')
                    <p><strong>Admin Notes:</strong> {{ $adminNotes }}</p>
                @endif
            </div>
            
            <p>We appreciate your vigilance in helping maintain our community standards. If you notice any future violations, please don't hesitate to submit another report.</p>
            
        @elseif($recipientType === 'owner')
            <p>We want to inform you about a recent report regarding your post.</p>
            
            <div class="info-box">
                <h4>Post Details:</h4>
                <p><strong>Post Title:</strong> {{ $postTitle }}</p>
                <p><strong>Report ID:</strong> #{{ $reportId }}</p>
            </div>
            
            <div class="note-box">
                <h4>Good News:</h4>
                <p>After reviewing the report about your post, our team has determined that your content does not violate our community guidelines. The report has been <strong>dismissed</strong>.</p>
                @if($adminNotes && $adminNotes !== 'No additional notes provided')
                    <p><strong>Admin Notes:</strong> {{ $adminNotes }}</p>
                @endif
            </div>
            
            <p>Your post remains active on our platform. Thank you for being a valuable member of our community!</p>
        @endif
        
        <p>If you have any questions about this decision, please contact our support team.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="button">Visit Our Platform</a>
        </div>
    </div>
    
    <div class="footer">
        <p>This is an automated message, please do not reply directly to this email.</p>
        <p>&copy; {{ date('Y') }} FURNITURE INTERNATIONAL GROUP. All rights reserved.</p>
    </div>
</body>
</html>