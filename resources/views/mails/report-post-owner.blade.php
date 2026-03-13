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
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: #333;
            padding: 30px 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            color: #333;
        }

        .content {
            padding: 30px;
            background: white;
        }

        .notice-badge {
            background: #ffc107;
            color: #333;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        .info-box {
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }

        .user-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #e0e0e0;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #ffc107;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .user-email {
            color: #666;
            font-size: 14px;
        }

        .post-preview {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .post-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin: 0 0 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ffc107;
        }

        .post-content {
            color: #555;
            margin: 15px 0;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .post-meta {
            font-size: 13px;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }

        .message-bubble {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #ffc107;
            box-shadow: 0 2px 4px rgba(255, 193, 7, 0.1);
        }

        .message-bubble strong {
            color: #856404;
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .message-bubble p {
            margin: 0;
            color: #333;
            font-size: 15px;
        }

        .image-container {
            margin: 15px 0;
            text-align: center;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .image-caption {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }

        .guidelines-box {
            background: #e7f3ff;
            border: 1px solid #b8daff;
            color: #004085;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .guidelines-box h4 {
            margin: 0 0 10px;
            color: #004085;
        }

        .guidelines-box ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }

        .guidelines-box li {
            margin: 5px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            background: #ffc107;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            margin: 5px 0;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background: #ff9800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .button-secondary {
            background: #6c757d;
            color: white;
        }

        .button-secondary:hover {
            background: #5a6268;
        }

        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 25px 0;
        }

        .stats-mini {
            display: flex;
            justify-content: space-between;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }

        .stat-item {
            flex: 1;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #666;
            font-size: 13px;
            border-top: 1px solid #e0e0e0;
        }

        .footer a {
            color: #ffc107;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .support-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .support-box h4 {
            margin: 0 0 10px;
            color: #333;
        }

        .support-link {
            display: inline-block;
            margin: 0 10px;
            color: #ffc107;
            text-decoration: none;
            font-weight: 600;
        }

        .support-link:hover {
            text-decoration: underline;
        }
    </style>
    @php
    // Ensure we have the necessary data
    if(!isset($report) || !$report) {
        $report = new stdClass();
    }
@endphp
</head>

<body>
    <div class="container">
        <div class="header">
            <span class="notice-badge">📢 CONTENT NOTIFICATION</span>
            <h2>Your Post Has Been Reported</h2>
            <p>We want to keep our community safe and respectful</p>
        </div>

        <div class="content">
            <!-- Personal Greeting -->
            <div style="margin-bottom: 25px;">
                <p style="font-size: 16px; color: #333;">Hello <strong>{{ $report->reportedUser->name ?? 'Community Member' }}</strong>,</p>
                <p style="color: #555;">We're reaching out to let you know that one of your posts has been reported by another community member. We take these matters seriously to maintain a positive environment for everyone.</p>
            </div>

            <!-- Quick Stats -->
            <div class="stats-mini">
                <div class="stat-item">
                    <div class="stat-value">{{ $report->id }}</div>
                    <div class="stat-label">Report ID</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $report->created_at->format('M d, Y') }}</div>
                    <div class="stat-label">Date</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">
                        <span class="status-badge status-pending">Under Review</span>
                    </div>
                    <div class="stat-label">Status</div>
                </div>
            </div>

            <!-- Your Post -->
            <h3 style="color: #333; margin: 25px 0 15px;">📝 Your Reported Post</h3>

            <div class="post-preview">
                <div class="post-title">
                    {{ $report->feed->title ?? 'Untitled Post' }}
                </div>

                @if($report->feed)
                <div class="post-content">
                    {{ $report->feed->content ?? 'No content available' }}
                </div>

                @if($report->feed->image)
                @php
                // Handle image URL properly
                $imagePath = $report->feed->image;
                $fullImageUrl = '';

                // Check if it's already a full URL
                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $fullImageUrl = $imagePath;
                }
                // Check if it starts with storage/
                elseif (strpos($imagePath, 'storage/') === 0) {
                $fullImageUrl = asset($imagePath);
                }
                // Check if it starts with public/
                elseif (strpos($imagePath, 'public/') === 0) {
                $fullImageUrl = asset(str_replace('public/', 'storage/', $imagePath));
                }
                // Default case - assume it's in storage
                else {
                // Remove any leading slashes
                $cleanPath = ltrim($imagePath, '/');
                $fullImageUrl = asset('storage/' . $cleanPath);
                }
                @endphp
                <div class="image-container">
                    <img src="{{ $fullImageUrl }}"
                        alt="Your post image"
                        style="max-width:100%; height:auto; border-radius:4px;"
                        onerror="this.onerror=null; this.parentElement.innerHTML='<div style=\'background:#f8d7da; color:#721c24; padding:15px; border-radius:8px; text-align:center;\'>⚠️ Image could not be loaded. File: {{ basename($imagePath) }}</div>';">
                    <div class="image-caption">📷 Image attached to your post</div>
                </div>
                @endif

                <div class="post-meta">
                    <strong>Posted:</strong> {{ $report->feed->created_at ? $report->feed->created_at->format('F j, Y \a\t g:i A') : 'Unknown' }}<br>
                    <strong>Post ID:</strong> {{ $report->feed->id }}
                </div>
                @else
                <div class="info-box">
                    <p style="margin:0;"><strong>Note:</strong> This post may have been removed or is no longer available.</p>
                </div>
                @endif
            </div>

            <!-- Report Details -->
            <h3 style="color: #333; margin: 25px 0 15px;">⚠️ Report Details</h3>

            <div class="message-bubble">
                <strong>📋 Reason for Report</strong>
                <p>{{ $report->message ?? 'No specific reason provided' }}</p>
            </div>

            <!-- Community Guidelines -->
            <div class="guidelines-box">
                <h4>📚 Our Community Guidelines</h4>
                <p>To help you understand what might have triggered this report, here are our key community principles:</p>
                <ul>
                    <li><strong>Be respectful:</strong> Treat others with kindness and respect</li>
                    <li><strong>No harassment:</strong> Bullying or harassment is not tolerated</li>
                    <li><strong>Appropriate content:</strong> Keep content suitable for all ages</li>
                    <li><strong>No spam:</strong> Avoid excessive or misleading posts</li>
                    <li><strong>Stay on topic:</strong> Keep content relevant to the community</li>
                </ul>
                <p style="margin-top: 10px;">
                    <a href="{{ url('/guidelines') }}" style="color: #004085; font-weight: 600;">Read full guidelines →</a>
                </p>
            </div>

            <!-- What Happens Next -->
            <div class="info-box">
                <h4 style="margin: 0 0 10px; color: #856404;">🔍 What Happens Next?</h4>
                <ol style="margin: 0 0 0 20px; padding-left: 0; color: #856404;">
                    <li style="margin-bottom: 8px;">Our moderation team will review the report (usually within 24-48 hours)</li>
                    <li style="margin-bottom: 8px;">We'll evaluate if the post violates our community guidelines</li>
                    <li style="margin-bottom: 8px;">If necessary, we may remove the content or take other appropriate action</li>
                    <li style="margin-bottom: 8px;">You'll receive an email with the outcome of the review</li>
                </ol>
            </div>

            <!-- Your Options -->
            <h3 style="color: #333; margin: 25px 0 15px;">📋 Your Options</h3>

            <div style="display: grid; gap: 15px; margin: 20px 0;">
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e0e0e0;">
                    <h4 style="margin: 0 0 5px; color: #333;">✏️ Edit Your Post</h4>
                    <p style="margin: 0 0 10px; color: #666;">If you think your post might have been misunderstood, you can edit it from your profile page.</p>
                    @if($report->reportedUser)
                    <!-- Link to profile page where user can edit their posts -->
                    <a href="{{ url('/profile/'  }}" class="button" style="font-size: 14px; padding: 8px 15px;">Go to My Profile</a>
                    @endif
                </div>

                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e0e0e0;">
                    <h4 style="margin: 0 0 5px; color: #333;">💬 Contact Support</h4>
                    <p style="margin: 0 0 10px; color: #666;">If you have questions about this report, our support team is here to help.</p>
                    <a href="mailto:support@{{ config('app.domain') }}" class="button button-secondary" style="font-size: 14px; padding: 8px 15px;">Email Support</a>
                </div>
            </div>

            <!-- Important Reminder -->
            <div class="info-box" style="background: #d4edda; border-left-color: #28a745;">
                <h4 style="margin: 0 0 10px; color: #155724;">💡 Important Reminder</h4>
                <p style="margin: 0; color: #155724;">
                    This report is not a punishment - it's a way for our community to help maintain a positive environment.
                    We review each report carefully and fairly. Most reports are resolved without any action needed.
                </p>
            </div>

            <!-- Simple Support Section -->
            <div class="support-box">
                <h4>🤝 Need Help?</h4>
                <p>Our support team is available to assist you with any questions or concerns.</p>
                <div>
                    <a href="mailto:support@{{ config('app.domain') }}" class="support-link">📧 support@{{ config('app.domain') }}</a>
                    <a href="{{ url('/help') }}" class="support-link">❓ Help Center</a>
                </div>
            </div>

            <!-- Report Reference -->
            <div style="font-size: 12px; color: #999; text-align: center; margin-top: 20px;">
                <p>Report Reference: #{{ $report->id }} | Submitted: {{ $report->created_at->format('F j, Y \a\t g:i:s A') }}</p>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This is an automated message regarding your post in the {{ config('app.name') }} community.</p>
            <p style="margin-top: 10px;">
                <a href="{{ url('/privacy') }}">Privacy Policy</a> •
                <a href="{{ url('/terms') }}">Terms of Service</a>
            </p>
        </div>
    </div>
</body>

</html>