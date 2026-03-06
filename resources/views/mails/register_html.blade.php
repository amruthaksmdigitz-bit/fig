<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New User Registration - Furniture International Group</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #e0e6ef;
        }
        .header {
            background: #1a3a5f;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        .header .subtitle {
            margin-top: 5px;
            opacity: 0.9;
            font-size: 13px;
        }
        .content {
            padding: 25px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .details-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 12px 15px;
            font-weight: 600;
            color: #495057;
            border: 1px solid #dee2e6;
            font-size: 14px;
            width: 35%;
        }
        .details-table td {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }
        .profile-section {
            background: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #cbd5e0;
            margin-bottom: 10px;
        }
        .status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-verified {
            background-color: #d4edda;
            color: #155724;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .empty-value {
            color: #6c757d;
            font-style: italic;
        }
        .footer {
            background-color: #f1f5f9;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .action-link {
            display: inline-block;
            background: #2c5282;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🏪 Furniture International Group</h2>
            <div class="subtitle">New User Registration Notification</div>
        </div>
        
        <div class="content">
            <p style="margin-top: 0;">Hello Admin,</p>
            <p>A new user has registered on the Furniture International Group platform. Here are the complete details:</p>

            <!-- Basic Information -->
            <table class="details-table">
                <tr>
                    <th>Full Name</th>
                    <td>{{ $user->name ?? '<span class="empty-value">Not provided</span>' }}</td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td>{{ $user->email ?? '<span class="empty-value">Not provided</span>' }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>
                        @if($locationName && $locationName !== 'Not specified')
                            📍 {{ $locationName }}
                        @else
                            <span class="empty-value">Location not specified</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>User Role</th>
                    <td>
                        @if($user->role)
                            {{ $user->role->name ?? 'N/A' }}
                        @else
                            <span class="empty-value">Role not assigned</span>
                        @endif
                    </td>
                </tr>
            </table>

            <!-- Description -->
            @if($user->description)
            <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 6px; border-left: 4px solid #1a3a5f;">
                <div style="font-weight: 600; color: #495057; margin-bottom: 8px;">User Description:</div>
                <div style="color: #333;">{{ $user->description }}</div>
            </div>
            @endif

            <!-- Profile Images Section -->
            <div class="profile-section">
                @if($user->profile_image)
                    <div style="font-weight: 600; margin-bottom: 10px; color: #495057;">Profile Image:</div>
                    <img src="{{ asset('storage/' . $user->profile_image) }}" 
                         alt="Profile" 
                         class="profile-img"
                         onerror="this.style.display='none';">
                @else
                    <div style="color: #6c757d; font-style: italic;">No profile image uploaded</div>
                @endif
            </div>

            <!-- Account Status -->
            <table class="details-table">
                <tr>
                    <th>Email Verification</th>
                    <td>
                        @if($user->email_verified_at)
                            <span class="status status-verified">✅ Verified</span>
                            <div style="font-size: 12px; margin-top: 5px;">
                                Verified on: {{ $user->email_verified_at->format('M j, Y') }}
                            </div>
                        @else
                            <span class="status status-pending">⏳ Pending Verification</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td>
                        {{ $user->created_at->format('F j, Y \a\t g:i A') }}
                        <div style="font-size: 12px; color: #6c757d;">
                            ({{ $user->created_at->diffForHumans() }})
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Last Login</th>
                    <td>
                        @if($user->last_login_at)
                            {{ $user->getLastLoginDisplayAttribute() }}
                            <div style="font-size: 12px; color: #6c757d;">
                                {{ $user->last_login_at->format('M j, Y \a\t g:i A') }}
                            </div>
                        @else
                            <span class="empty-value">Never logged in</span>
                        @endif
                    </td>
                </tr>
            </table>

            <!-- Additional Images Info -->
            @if($user->multipleImages && $user->multipleImages->count() > 0)
            <div style="margin: 20px 0; padding: 12px; background: #e8f4fd; border-radius: 6px; border: 1px solid #b8daff;">
                <div style="font-weight: 600; color: #004085;">
                    📸 Additional Images: {{ $user->multipleImages->count() }} uploaded
                </div>
            </div>
            @endif

            <!-- Admin Action -->
            <div style="text-align: center; margin-top: 25px; padding-top: 20px; border-top: 1px dashed #dee2e6;">
                <a href="{{ url('/admin/users/' . $user->id) }}" class="action-link">
                    👁️ View Complete Profile in Admin Panel
                </a>
                <div style="margin-top: 10px; font-size: 12px; color: #6c757d;">
                    User ID: #{{ $user->id }}
                </div>
            </div>
        </div>

        <div class="footer">
            <div style="margin-bottom: 8px;">
                <strong>Furniture International Group</strong> | User Management System
            </div>
            <div>
                This is an automated notification. Please do not reply to this email.
                <br>
                © {{ date('Y') }} All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>