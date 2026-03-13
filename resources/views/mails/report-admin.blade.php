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
            background: linear-gradient(135deg, #dc3545, #c82333);
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

        .alert-badge {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        .admin-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #dc3545;
            margin: 20px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 12px;
            margin: 20px 0;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
        }

        .info-value {
            color: #212529;
        }

        .user-card {
            background: #f1f3f4;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #e0e0e0;
        }

        .user-card h4 {
            margin: 0 0 10px;
            color: #495057;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .message-bubble {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
        }

        .message-bubble strong {
            color: #dc3545;
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .message-bubble p {
            margin: 0;
            color: #333;
            font-size: 15px;
            white-space: pre-wrap;
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

        .screenshot-preview {
            margin: 15px 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #cce5ff;
        }

        .screenshot-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            margin: 5px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #dc3545;
            color: white;
        }

        .btn-primary:hover {
            background: #c82333;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin: 25px 0;
        }

        .quick-actions {
            background: #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .quick-actions h4 {
            margin: 0 0 15px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .link-note {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 12px;
            border-radius: 5px;
            font-size: 14px;
            margin: 15px 0;
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

        .status-resolved {
            background: #d4edda;
            color: #155724;
        }

        .status-dismissed {
            background: #e2e3e5;
            color: #383d41;
        }

        .post-preview {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .post-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0 0 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #dc3545;
        }

        .post-content {
            color: #555;
            margin: 15px 0;
            line-height: 1.6;
        }

        .post-meta {
            font-size: 13px;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
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
            color: #dc3545;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
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

        .image-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 13px;
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

        .login-note {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }

        .login-note a {
            color: #155724;
            font-weight: 600;
            text-decoration: underline;
        }

        .feeds-link {
            background: #e7f3ff;
            border: 1px solid #b8daff;
            color: #004085;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
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
            <span class="alert-badge">⚠️ NEW MODERATION REQUIRED</span>
            <h2>🔔 New Report Submitted</h2>
            <p>Report #{{ $report->id }} requires your attention</p>
        </div>

        <div class="content">
            <!-- Priority Notice -->
            <div class="admin-box">
                <p style="margin:0; font-size:16px;">
                    <strong>⏰ Action Required:</strong> A new report has been submitted and needs review by the moderation team.
                    Priority level: <strong style="color:#dc3545;">High</strong>
                </p>
            </div>

            <!-- Login Note - Important for Admin Access -->
            <div class="login-note">
                <strong>🔐 Admin Access:</strong> Please <a href="{{ url('/login') }}">login as admin</a> first to access the admin panel.
                After logging in, use the links below to review this report.
            </div>

            <!-- Quick Stats -->
            <div class="stats-mini">
                <div class="stat-item">
                    <div class="stat-value">{{ $report->id }}</div>
                    <div class="stat-label">Report ID</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">
                        <span class="status-badge status-pending">Pending</span>
                    </div>
                    <div class="stat-label">Status</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $report->created_at->format('M d') }}</div>
                    <div class="stat-label">Date</div>
                </div>
            </div>

            <!-- Report Details -->
            <h3 style="color:#333; margin:20px 0 15px;">📋 Report Details</h3>

            <div class="info-grid">
                <span class="info-label">Report ID:</span>
                <span class="info-value"><strong>#{{ $report->id }}</strong></span>

                <span class="info-label">Submitted:</span>
                <span class="info-value">{{ $report->created_at->format('F j, Y \a\t g:i:s A') }}</span>

                <span class="info-label">Time Elapsed:</span>
                <span class="info-value">{{ $report->created_at->diffForHumans() }}</span>

                <span class="info-label">Current Status:</span>
                <span class="info-value">
                    <span class="status-badge status-pending">Pending Review</span>
                </span>
            </div>

            <!-- Reporter Information -->
            <div class="user-card">
                <h4>👤 Reporter Information</h4>
                <div style="display:flex; align-items:center; gap:15px;">
                    <div style="width:50px; height:50px; border-radius:50%; background:#dc3545; display:flex; align-items:center; justify-content:center; color:white; font-size:20px; font-weight:600;">
                        {{ $report->reporter && $report->reporter->name ? substr($report->reporter->name, 0, 1) : '?' }}
                    </div>
                    <div>
                        <div style="font-weight:600; font-size:16px;">{{ $report->reporter->name ?? 'Unknown' }}</div>
                        <div style="color:#666;">{{ $report->reporter->email ?? 'No email' }}</div>
                        <div style="font-size:12px; color:#999;">User ID: {{ $report->reporter->id ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Reported User Information -->
            <div class="user-card">
                <h4>🚫 Reported User Information</h4>
                <div style="display:flex; align-items:center; gap:15px;">
                    <div style="width:50px; height:50px; border-radius:50%; background:#6c757d; display:flex; align-items:center; justify-content:center; color:white; font-size:20px; font-weight:600;">
                        {{ $report->reportedUser && $report->reportedUser->name ? substr($report->reportedUser->name, 0, 1) : '?' }}
                    </div>
                    <div>
                        <div style="font-weight:600; font-size:16px;">{{ $report->reportedUser->name ?? 'Unknown' }}</div>
                        <div style="color:#666;">{{ $report->reportedUser->email ?? 'No email' }}</div>
                        <div style="font-size:12px; color:#999;">User ID: {{ $report->reportedUser->id ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Reported Post -->
            <h3 style="color:#333; margin:25px 0 15px;">📌 Reported Post</h3>

            <div class="post-preview">
                <div class="post-title">
                    {{ $report->feed->title ?? 'Untitled Post' }}
                </div>

                @if($report->feed)
                <div class="post-content">
                    {{ $report->feed->content ?? 'No content available' }}
                </div>

                <!-- Display Post Image -->
                <!-- Display Post Image -->
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
                        alt="Post image"
                        style="max-width:100%; height:auto; display:block; margin:0 auto; border-radius:4px;"
                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'image-error\'>⚠️ Image could not be loaded. Path: {{ basename($imagePath) }}</div>';">
                    <div class="image-caption">📷 Post Image</div>
                </div>
                @else
                <div class="link-note">
                    <strong>ℹ️ No Image:</strong> This post does not contain any images.
                </div>
                @endif

                <div class="post-meta">
                    <strong>Post ID:</strong> {{ $report->feed->id }}<br>
                    <strong>Created:</strong> {{ $report->feed->created_at ? $report->feed->created_at->format('F j, Y \a\t g:i A') : 'Unknown' }}<br>
                    <strong>Last Updated:</strong> {{ $report->feed->updated_at ? $report->feed->updated_at->format('F j, Y \a\t g:i A') : 'Unknown' }}<br>
                    @if(isset($report->feed->is_hidden) && $report->feed->is_hidden)
                    <strong style="color:#dc3545;">⚠️ This post is currently hidden</strong>
                    @endif
                </div>
                @else
                <div class="link-note">
                    <strong>⚠️ Notice:</strong> The reported post may have been deleted or is no longer available.
                </div>
                @endif
            </div>

            <!-- Report Message -->
            <div class="message-bubble">
                <strong>✉️ Reporter's Message</strong>
                <p>{{ $report->message ?? 'No message provided' }}</p>
            </div>

            <!-- Screenshot Evidence -->
            <!-- Screenshot Evidence -->
            @if($report->screenshot)
            @php
            // Handle screenshot path properly
            $screenshotPath = $report->screenshot;
            $fullScreenshotUrl = '';

            // Check if it's already a full URL
            if (filter_var($screenshotPath, FILTER_VALIDATE_URL)) {
            $fullScreenshotUrl = $screenshotPath;
            }
            // Check if it starts with storage/
            elseif (strpos($screenshotPath, 'storage/') === 0) {
            $fullScreenshotUrl = asset($screenshotPath);
            }
            // Check if it starts with public/
            elseif (strpos($screenshotPath, 'public/') === 0) {
            $fullScreenshotUrl = asset(str_replace('public/', 'storage/', $screenshotPath));
            }
            // Default case - assume it's in storage
            else {
            // Remove any leading slashes
            $cleanPath = ltrim($screenshotPath, '/');
            $fullScreenshotUrl = asset('storage/' . $cleanPath);
            }
            @endphp
            <div class="screenshot-box">
                <h4>
                    <span>📸</span> Supporting Evidence
                </h4>
                <p style="margin:0 0 10px; color:#666;">The reporter uploaded this screenshot as evidence:</p>
                <div class="screenshot-preview">
                    <img src="{{ $fullScreenshotUrl }}"
                        alt="Report screenshot"
                        style="max-width:100%; height:auto; display:block; border-radius:4px;"
                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'image-error\'>⚠️ Screenshot could not be loaded. Path: {{ basename($screenshotPath) }}</div>';">
                </div>
                <div style="margin-top:10px; text-align:center;">
                    <a href="{{ $fullScreenshotUrl }}"
                        class="btn btn-info"
                        style="font-size:13px; padding:8px 15px; display:inline-block;"
                        target="_blank">
                        📸 View Full Screenshot
                    </a>
                    <a href="{{ $fullScreenshotUrl }}"
                        class="btn btn-secondary"
                        style="font-size:13px; padding:8px 15px; display:inline-block;"
                        download>
                        📥 Download Screenshot
                    </a>
                </div>
            </div>
            @endif

            <!-- Admin View Buttons (No action links) -->
            <div class="quick-actions">
                <h4>⚡ Admin Review Links</h4>

                <!-- View Links - These require admin login -->
                <div style="margin-bottom:15px;">
                    <a href="{{ route('admin.reports.show', $report->id) }}"
                        class="btn btn-primary"
                        style="width:100%; text-align:center; box-sizing:border-box; display:block;">
                        🔍 View Full Report in Admin Panel
                    </a>
                </div>

                <!-- Feeds link - updated to feeds index -->
                <div class="feeds-link">
                    <strong>📱 View All Feeds:</strong><br>
                    <a href="{{ url('/feeds') }}" style="color:#004085; font-weight:600;" target="_blank">
                        {{ url('/feeds') }}
                    </a>
                    <p style="margin:5px 0 0; font-size:12px;">Browse all community posts</p>
                </div>


            </div>

            <!-- Important Note About Admin Access -->
            <div class="link-note">
                <strong>🔑 Important:</strong> To access the admin panel and take moderation actions:
                <ol style="margin:10px 0 0 20px;">
                    <li>First click the login link below</li>
                    <li>Login with your admin credentials</li>
                    <li>Then click the admin panel links above</li>
                </ol>
            </div>

            <!-- Direct Links Section -->
            <h3 style="color:#333; margin:25px 0 15px;">🔗 Direct Links</h3>

            <div style="background:#e9ecef; padding:15px; border-radius:5px; word-break:break-all;">
                <strong>Login Page:</strong><br>
                <a href="{{ url('/login') }}" style="color:#dc3545;">
                    {{ url('/login') }}
                </a>

                <br><br>

                <strong>Admin Report URL:</strong><br>
                <a href="{{ route('admin.reports.show', $report->id) }}" style="color:#dc3545;">
                    {{ route('admin.reports.show', $report->id) }}
                </a>

                <br><br>

                @if($report->feed)




                <strong>All Feeds:</strong><br>
                <a href="{{ url('/feeds') }}" style="color:#dc3545;">
                    {{ url('/feeds') }}
                </a>

                <br><br>
                @endif

                <strong>Admin Reports Dashboard:</strong><br>
                <a href="{{ route('admin.reports.index') }}" style="color:#dc3545;">
                    {{ route('admin.reports.index') }}
                </a>
            </div>

            <!-- Admin Instructions -->
            <div class="link-note">
                <strong>📋 Instructions for Admin Access:</strong>
                <ol style="margin:10px 0 0; padding-left:20px;">
                    <li>Click the login link and sign in with your admin account</li>
                    <li>After successful login, return to this email</li>
                    <li>Click the "View Full Report" link to access the admin panel</li>
                    <li>Review the report and take appropriate action</li>
                </ol>
            </div>

            <!-- Additional Context -->
            <div class="link-note">
                <strong>ℹ️ Review Guidelines:</strong>
                <ul style="margin:10px 0 0; padding-left:20px;">
                    <li>Check if this user has previous reports</li>
                    <li>Review the reported post for guideline violations</li>
                    <li>Consider the severity before taking action</li>
                    <li>Document your decision in admin notes</li>
                </ul>
            </div>

            <!-- Similar Reports -->
            @if(isset($similarReports) && $similarReports->count() > 0)
            <div style="margin:25px 0;">
                <h4 style="color:#333;">📊 Similar Reports ({{ $similarReports->count() }})</h4>
                <div style="background:#f8f9fa; padding:15px; border-radius:8px;">
                    @foreach($similarReports as $similar)
                    <div style="padding:10px; border-bottom:1px solid #e0e0e0;">
                        <strong>Report #{{ $similar->id }}</strong> -
                        {{ $similar->created_at ? $similar->created_at->diffForHumans() : 'Unknown' }}
                        <br>
                        <small>Status: {{ $similar->status ?? 'Unknown' }}</small>
                        <br>
                        <a href="{{ route('admin.reports.show', $similar->id) }}">View Similar Report</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Report Metadata -->
            <div class="divider"></div>

            <div style="font-size:12px; color:#666;">
                <strong>System Information:</strong><br>
                Report generated: {{ now()->format('Y-m-d H:i:s') }}<br>
                Server: {{ $_SERVER['SERVER_NAME'] ?? 'localhost' }}<br>
                IP Address: {{ request()->ip() ?? 'Unknown' }}<br>
                User Agent: {{ request()->userAgent() ?? 'Unknown' }}
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This is an automated admin notification from {{ config('app.name') }}.</p>
            <p style="margin-top:10px;">
                <a href="{{ url('/login') }}">Admin Login</a> •
                <a href="{{ url('/admin') }}">Admin Dashboard</a> •
                <a href="{{ route('admin.reports.index') }}">All Reports</a>
            </p>
        </div>
    </div>
</body>

</html>