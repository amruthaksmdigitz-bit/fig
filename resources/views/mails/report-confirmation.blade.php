<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
            background: white;
        }

        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .report-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
        }

        .post-preview {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e0e0e0;
            margin-right: 15px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: #333;
            margin: 0;
            font-size: 16px;
        }

        .user-username {
            color: #666;
            font-size: 14px;
            margin: 2px 0 0;
        }

        .post-date {
            color: #666;
            font-size: 13px;
            margin: 5px 0 0;
        }

        .post-title-section {
            background: #f0f7ff;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #cce5ff;
        }

        .post-title-label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0056b3;
            margin: 0 0 5px;
            font-weight: 600;
        }

        .post-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin: 0;
            line-height: 1.4;
        }

        .post-content {
            color: #333;
            margin: 15px 0 20px;
            line-height: 1.6;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .post-image {
            margin: 15px 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .post-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .screenshot-box {
            background: #f0f7ff;
            border: 1px solid #cce5ff;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }

        .screenshot-box h4 {
            margin: 0 0 10px;
            color: #0056b3;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .screenshot-image {
            margin: 10px 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #cce5ff;
        }

        .screenshot-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .message-bubble {
            background: #f1f3f4;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .message-bubble strong {
            color: #28a745;
            display: block;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-bubble p {
            margin: 0;
            color: #333;
            font-style: italic;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            margin: 15px 0;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #218838;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .link-note {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #666;
            font-size: 13px;
            border-top: 1px solid #e0e0e0;
        }

        .footer p {
            margin: 5px 0;
        }

        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 25px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 12px;
            margin: 15px 0;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }

        .info-value {
            color: #333;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            background: #e9ecef;
            color: #495057;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .step-number {
            background: #28a745;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-content strong {
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .step-content p {
            margin: 0;
            color: #666;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
    @php
    use Illuminate\Support\Str;
@endphp
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>✅ Report Confirmation</h2>
            <p>Your report has been successfully submitted</p>
        </div>

        <div class="content">
            <div class="greeting">
                Hello <strong>{{ $report->reporter->name }}</strong>,
            </div>

            <div class="report-box">
                <p style="margin:0; font-size:16px;">Thank you for helping keep {{ config('app.name') }} safe! Your report has been received and will be reviewed by our team within 24-48 hours.</p>
            </div>

            <!-- Report Summary -->
            <h3 style="color:#333; margin:25px 0 15px; display:flex; align-items:center; gap:8px;">
                <span>📋</span> Report Summary
            </h3>

            <div class="info-grid">
                <span class="info-label">Report ID:</span>
                <span class="info-value"><span class="badge">#{{ $report->id }}</span></span>

                <span class="info-label">Date Submitted:</span>
                <span class="info-value">{{ $report->created_at->format('F j, Y, g:i a') }}</span>

                <span class="info-label">Reported User:</span>
                <span class="info-value">{{ $report->reportedUser->name }}
                    @if($report->reportedUser->username)
                    <span style="color:#666;">(@{{ $report->reportedUser->username }})</span>
                    @endif
                </span>

                <span class="info-label">Report Type:</span>
                <span class="info-value"><span class="badge badge-warning">Post Violation</span></span>
            </div>

            <!-- Reported Post Context -->
            <h3 style="color:#333; margin:30px 0 15px; display:flex; align-items:center; gap:8px;">
                <span>📌</span> Reported Post
            </h3>

            <div class="post-preview">
                <div class="post-header">
                    <div class="user-avatar">
                        @if($report->feed->user->profile_image)
                        <img src="{{ asset('storage/' . $report->feed->user->profile_image) }}" alt="{{ $report->feed->user->name }}">
                        @else
                        <div style="width:100%; height:100%; background: #28a745; display:flex; align-items:center; justify-content:center; color:white; font-size:20px; font-weight:600;">
                            {{ substr($report->feed->user->name, 0, 1) }}
                        </div>
                        @endif
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ $report->feed->user->name }}</div>
                        @if($report->feed->user->username)
                        <div class="user-username">@{{ $report->feed->user->username }}</div>
                        @endif
                        <div class="post-date">{{ $report->feed->created_at->format('F j, Y \a\t g:i a') }}</div>
                    </div>
                </div>

                <!-- Post Title Section -->
                @if($report->feed->title)
                <div class="post-title-section">
                    <div class="post-title-label">📝 Post Title</div>
                    <div class="post-title">{{ $report->feed->title }}</div>
                </div>
                @endif

                <div class="post-content">
                    <strong style="display:block; margin-bottom:8px; color:#28a745;">Post Content:</strong>
                    {{ $report->feed->content }}
                </div>

                @if($report->feed->image)
                <div class="post-image">
                    <img src="{{ asset('storage/' . $report->feed->image) }}" alt="Post image">
                </div>
                @endif
            </div>

            <!-- Your Report Message -->
            <div class="message-bubble">
                <strong>
                    <span>✏️</span> Your Report Message:
                </strong>
                <p>{{ $report->message }}</p>
            </div>

            <!-- Your Screenshot (if uploaded) -->
            <!-- Your Screenshot (if uploaded) -->
            @if($report->screenshot)
            @php
            // Handle different screenshot path formats
            $screenshotPath = $report->screenshot;
            $fullScreenshotUrl = '';

            if (Str::startsWith($screenshotPath, 'http')) {
            // If it's already a full URL
            $fullScreenshotUrl = $screenshotPath;
            } elseif (Str::startsWith($screenshotPath, 'storage/')) {
            // If it starts with storage/
            $fullScreenshotUrl = asset($screenshotPath);
            } elseif (Str::startsWith($screenshotPath, 'public/')) {
            // If it starts with public/
            $fullScreenshotUrl = asset(str_replace('public/', 'storage/', $screenshotPath));
            } else {
            // Default case - assume it's in storage
            $fullScreenshotUrl = asset('storage/' . ltrim($screenshotPath, '/'));
            }
            @endphp
            <div class="screenshot-box">
                <h4>
                    <span>📸</span> Your Supporting Screenshot
                </h4>99
                <p style="margin:0 0 10px; color:#666;">This screenshot will help our moderators understand the context better:</p>
                <div class="screenshot-image">
                    <img src="{{ $fullScreenshotUrl }}"
                        alt="Report screenshot"
                        style="max-width:100%; height:auto; display:block;"
                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}'; this.parentElement.innerHTML+='<div style=\'background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-top:10px;\'>⚠️ Screenshot could not be loaded. Please contact support.</div>';">
                </div>
                <div style="margin-top:15px; text-align:center;">
                    <a href="{{ $fullScreenshotUrl }}"
                        class="btn btn-secondary"
                        style="padding:8px 15px; font-size:13px; display:inline-block;"
                        target="_blank">
                        🔍 View Full Screenshot
                    </a>
                </div>
                <p style="margin:10px 0 0; font-size:13px; color:#666;">⬆️ Screenshot you uploaded</p>
            </div>
            @endif

            <!-- Link to Post -->
            <h3 style="color:#333; margin:25px 0 10px; display:flex; align-items:center; gap:8px;">
                <span>🔗</span> Direct Link to Post
            </h3>

            <div style="background:#e9ecef; padding:15px; border-radius:5px; word-break:break-all; margin-bottom:15px;">
                <a href="{{ url('/feeds/' ) }}" style="color:#28a745; text-decoration:none; font-weight:500;">
                    {{ url('/feeds') }}
                </a>
            </div>

            <div class="link-note">
                <strong>ℹ️ Note:</strong> Make sure you're logged in to view this post. If the post violates our guidelines, it may be removed after review.
            </div>

            <div class="button-group">
                <a href="{{ url('/feeds/') }}" class="btn">🔍 View Reported Post</a>

            </div>

            <!-- What Happens Next -->
            <div class="divider"></div>

            <h3 style="color:#333; margin:0 0 20px; display:flex; align-items:center; gap:8px;">
                <span>⏳</span> What Happens Next?
            </h3>

            <div style="margin-bottom:20px;">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <strong>Review Process</strong>
                        <p>Our moderation team will review the reported post <strong>"{{ $report->feed->title ?? 'Untitled' }}"</strong> within 24-48 hours.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <strong>Decision Making</strong>
                        <p>Based on our community guidelines, we'll determine if the post violates our policies. Your provided screenshot and message will be carefully reviewed.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <strong>Action Taken</strong>
                        <p>If violations are found, appropriate action will be taken. You may receive an update on the resolution via email.</p>
                    </div>
                </div>
            </div>

            <!-- Post Information Card -->
            <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding:20px; border-radius:8px; margin:20px 0;">
                <h4 style="margin:0 0 15px; color:#333; display:flex; align-items:center; gap:8px;">
                    <span>📊</span> Post Statistics
                </h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                    <div>
                        <div style="font-size:13px; color:#666;">Post ID</div>
                        <div style="font-weight:600; color:#333;">#{{ $report->feed_id }}</div>
                    </div>
                    <div>
                        <div style="font-size:13px; color:#666;">Status</div>
                        <div style="font-weight:600; color:#28a745;">Under Review</div>
                    </div>
                    @if($report->feed->title)
                    <div style="grid-column:span 2;">
                        <div style="font-size:13px; color:#666;">Title</div>
                        <div style="font-weight:600; color:#333;">{{ $report->feed->title }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Important Notes -->
            <div class="divider"></div>

            <div style="background:#f8f9fa; padding:15px; border-radius:8px;">
                <p style="margin:0; color:#666; font-size:14px;">
                    <strong>📝 Important:</strong> Please do not reply to this email. This is an automated confirmation of your report for the post
                    @if($report->feed->title)
                    <strong>"{{ $report->feed->title }}"</strong>
                    @else
                    #{{ $report->feed_id }}
                    @endif
                    . If you need to provide additional information about this report, please contact our support team directly.
                </p>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This is an automated message from {{ config('app.name') }}. Your report helps keep our community safe!</p>
            <p style="margin-top:10px;">
                <a href="{{ url('/privacy') }}" style="color:#666; text-decoration:none;">Privacy Policy</a> •
                <a href="{{ url('/guidelines') }}" style="color:#666; text-decoration:none;">Community Guidelines</a> •
                <a href="{{ url('/contact') }}" style="color:#666; text-decoration:none;">Contact Support</a>
            </p>
        </div>
    </div>
</body>

</html>