<!DOCTYPE html>
<html>
<head>
    <title>Profile Update Notification</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            color: #333; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f4;
        }
        .container { 
            max-width: 600px; 
            margin: 20px auto; 
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header { 
            background: #007bff; 
            color: white; 
            padding: 20px; 
            text-align: center;
        }
        .content { 
            padding: 30px; 
        }
        .footer { 
            margin-top: 20px; 
            padding: 20px;
            background: #f8f9fa;
            text-align: center;
            font-size: 12px; 
            color: #666;
            border-top: 1px solid #dee2e6;
        }
        .user-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
        }
        .changes {
            background: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔄 Profile Update Notification</h1>
        </div>
        
        <div class="content">
            <h2>User <strong>{{ $user->name }}</strong> has updated their profile.</h2>
            
            <div class="user-info">
                <h3>Updated Profile Details:</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><strong>👤 Name:</strong> {{ $user->name }}</li>
                    <li><strong>📧 Email:</strong> {{ $user->email }}</li>
                    <li><strong>📍 Location:</strong> {{ $user->location ?? 'Not specified' }}</li>
                    <li><strong>📝 Description:</strong> {{ $user->description ? substr($user->description, 0, 100) . (strlen($user->description) > 100 ? '...' : '') : 'Not specified' }}</li>
                    <li><strong>🕒 Update Time:</strong> {{ $updateTime }}</li>
                    <li><strong>✅ Approval Status:</strong> <span style="color: #dc3545;">Pending Approval</span></li>
                </ul>
            </div>

            @if($user->profile_image)
            <div style="margin: 15px 0;">
                <strong>🖼️ New Profile Image:</strong><br>
                <img src="{{ $message->embed(public_path($user->profile_image)) }}" alt="Profile Image" style="max-width: 200px; border-radius: 8px; margin: 10px 0;">
            </div>
            @endif

            @if($user->cover_image)
            <div style="margin: 15px 0;">
                <strong>📷 New Cover Image:</strong><br>
                <img src="{{ $message->embed(public_path($user->cover_image)) }}" alt="Cover Image" style="max-width: 300px; border-radius: 8px; margin: 10px 0;">
            </div>
            @endif

            <div class="changes">
                <p><strong>⚠️ Attention Required:</strong> This user's profile has been updated and is now pending admin approval. Please review the changes.</p>
            </div>
            
            <a href="{{ url('/admin/users/' . $user->id) }}" class="btn">
                👁️ Review User Profile
            </a>
            
            <p style="margin-top: 20px; color: #666;">
                <em>Please log in to the admin panel to approve or reject these changes.</em>
            </p>
        </div>
        
        <div class="footer">
            <p>This is an automated notification from {{ config('app.name', 'Laravel') }}</p>
            <p>© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>