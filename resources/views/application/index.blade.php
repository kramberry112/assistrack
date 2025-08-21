@extends('layouts.guest')

@section('content')
<div style="background: #fff; min-height: 100vh; padding: 0; font-family: Arial, sans-serif;">
    <header style="background: #fff; padding: 10px 40px; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <img src="/images/uddlogo.png" alt="UDD Logo" style="width: 45px; height: 45px;">
            <div style="font-size: 16px; font-weight: bold; color: #1a237e; line-height: 1.2;">
                UNIVERSIDAD DE DAGUPAN
            </div>
        </div>
        <nav style="display: flex; gap: 20px; font-size: 14px; font-weight: bold;">
            <a href="/about" style="color: #1a237e; text-decoration: none;">About</a>
            <a href="/welcome" style="color: #1a237e; text-decoration: none;">Home</a>
            <a href="#" style="color: #1a237e; text-decoration: none;">Contact Us</a>
            <a href="/login" style="color: #1a237e; text-decoration: none;">Login</a>
        </nav>
    </header>

    <main style="max-width: 1100px; margin: 40px auto; background: #fff; border-radius: 8px; border: 1px solid #ccc; padding: 30px 40px;">
        <h2 style="font-size: 32px; font-weight: bold; color: #002c77; margin-bottom: 24px;">List of Applicants</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f0f4fa; color: #002c77;">
                    <th style="padding: 8px; border: 1px solid #ccc;">#</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Name</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Course</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Block</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Age</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">ID Number</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Email</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Telephone</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                <tr>
                    <td style="padding: 8px; border: 1px solid #ccc; text-align: center;">{{ $loop->iteration }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->student_name }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->course }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->block }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->age }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->id_number }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->email }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->telephone }}</td>
                    <td style="padding: 8px; border: 1px solid #ccc;">{{ $app->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="padding: 16px; text-align: center; color: #888;">No applicants found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>

    <footer style="background: #1a237e; color: #fff; text-align: center; font-size: 12px; padding: 12px 0; margin-top: 40px;">
        &copy; 2023 - 2024 by MRCY Inc., a non-profit organization. All rights reserved.
    </footer>
</div>
@endsection
