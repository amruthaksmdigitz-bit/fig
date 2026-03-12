<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Deleted Notification</title>
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
            background-color: #dc3545;
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
            border-left: 4px solid #dc3545;
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
        <h2>Post Deletion Notification</h2>
    </div>
    
    <div class="content">
        <p>Hello <strong>{{ $recipientName }}</strong>,</p>
        
        @if($recipientType === 'reporter')
            <p>This is an update regarding the post you reported for violating our community guidelines.</p>
            
            <div class="info-box">
                <h4>Report Details:</h4>
                <p><strong>Reported Post:</strong> {{ $postTitle }}</p>
                <p><strong>Your Report Message:</strong> {{ $reportMessage }}</p>
                <p><strong>Status:</strong> The reported post has been reviewed and deleted by our admin team.</p>
            </div>
            
            <p>Thank you for helping us keep our community safe. Your report was valuable in maintaining our platform's standards.</p>
            
        @elseif($recipientType === 'owner')
            <p>We regret to inform you that your post has been deleted from our platform.</p>
            
            <div class="info-box">
                <h4>Post Details:</h4>
                <p><strong>Post Title:</strong> {{ $postTitle }}</p>
                <p><strong>Reason for Deletion:</strong> This post was reported for violating our community guidelines.</p>
                @if($adminNotes)
                    <p><strong>Admin Notes:</strong> {{ $adminNotes }}</p>
                @endif
            </div>
            
            <p>Please review our community guidelines to ensure your future posts comply with our policies.</p>
        @endif
        
        <p>If you have any questions or concerns, please don't hesitate to contact our support team.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="button">Visit Our Platform</a>
        </div>
    </div>
    
    <div class="footer">
        <p>This is an automated message, please do not reply directly to this email.</p>
        <p>&copy; {{ date('Y') }} Your Platform Name. All rights reserved.</p>
    </div>
</body>
</html>