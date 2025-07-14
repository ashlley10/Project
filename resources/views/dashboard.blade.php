<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef1f5;
            margin: 0;
            padding: 0;
        }

        .top-bar {
            background-color: rgb(228, 86, 173);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .title {
            font-size: 24px;
            font-weight: 600;
        }

        .layout {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        .sidebar {
            width: 220px;
            background-color: rgb(236, 112, 189);
            padding: 30px 20px;
            color: white;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a,
        .sidebar .logout-btn {
            color: white;
            text-decoration: none;
            font-weight: 500;
            background: none;
            border: none;
            padding: 0;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
            transition: opacity 0.2s;
        }

        .sidebar ul li a:hover,
        .sidebar .logout-btn:hover {
            text-decoration: underline;
            opacity: 0.9;
        }

        .container {
            flex: 1;
            margin: 40px;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgb(236, 112, 189);
        }

        h1 {
            font-size: 32px;
            color: rgb(236, 112, 189);
            margin-bottom: 30px;
            text-align: center;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .stat-box {
            flex: 1;
            background-color: #f3f4f6;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin: 0 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-box h2 {
            font-size: 24px;
            margin: 0;
            color: rgb(236, 112, 189);
        }

        .stat-box p {
            font-size: 16px;
            color: #666;
            margin-top: 8px;
        }

        .buttons {
            text-align: center;
        }

        .buttons a {
            background-color: rgb(236, 158, 210);
            color: white;
            padding: 14px 30px;
            margin: 0 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s, transform 0.2s;
        }

        .buttons a:hover {
            background-color: #d81dc8;
            transform: scale(1.05);
        }

        /* Edit Profile Form Styles */
        .edit-profile-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(236, 112, 189, 0.4);
        }

        .edit-profile-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: rgb(236, 112, 189);
            font-size: 28px;
            font-weight: 600;
        }

        .edit-profile-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #444;
        }

        .edit-profile-form input[type="text"],
        .edit-profile-form input[type="email"],
        .edit-profile-form input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 20px;
            border: 2px solid #e7d7e2;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            transition: border 0.3s, box-shadow 0.3s;
        }

        .edit-profile-form input:focus {
            border-color: rgb(236, 112, 189);
            outline: none;
            box-shadow: 0 0 0 3px rgba(236, 112, 189, 0.2);
        }

        .edit-profile-form button {
            background-color: rgb(236, 158, 210);
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s, transform 0.2s;
        }

        .edit-profile-form button:hover {
            background-color: #d81dc8;
            transform: scale(1.03);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
                padding: 20px;
            }

            .stats {
                flex-direction: column;
                gap: 20px;
            }

            .stat-box {
                margin: 0;
            }

            .buttons a {
                display: block;
                margin: 10px auto;
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <div class="title">Ashlley's Booking Dashboard</div>
    </div>

    <div class="layout">
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('bookings.index') }}">View Bookings</a></li>
                <li><a href="{{ route('bookings.create') }}">Create Booking</a></li>
                <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="container">
            <h1>Welcome, {{ auth()->user()->name }}</h1>

            <div class="stats">
                <div class="stat-box">
                    <h2>{{ $totalBookings }}</h2>
                    <p>Total Bookings</p>
                </div>
                <div class="stat-box">
                    <h2>{{ $totalUsers }}</h2>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="buttons">
                <a href="{{ route('bookings.index') }}">View Bookings</a>
                <a href="{{ route('bookings.create') }}">Create Booking</a>
            </div>
        </div>
    </div>

</body>
</html>




