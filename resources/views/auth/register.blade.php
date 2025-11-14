<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Sistem E-Commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --accent-color: #2563eb;
            --light-bg: #f8fafc;
            --text-dark: #0f172a;
            --text-light: #475569;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.6s ease-out;
        }

        .register-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 40px 35px;
            width: 100%;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .register-header {
            margin-bottom: 32px;
        }

        .register-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            letter-spacing: -0.025em;
        }

        .register-header p {
            color: var(--text-light);
            font-size: 0.875rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 16px;
            transition: color 0.2s;
        }

        .form-control {
            border-radius: 8px;
            background: var(--white);
            border: 1px solid var(--border-color);
            padding: 12px 16px 12px 44px;
            height: 48px;
            color: var(--text-dark);
            font-size: 0.875rem;
            transition: all 0.2s;
            width: 100%;
            font-weight: 400;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
            outline: none;
        }

        .form-control:focus + i {
            color: var(--primary-color);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 0.875rem;
            display: block;
        }

        .btn-register {
            background: var(--primary-color);
            color: var(--white);
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 0;
            margin-top: 8px;
            width: 100%;
            border: none;
            font-size: 0.875rem;
            transition: all 0.2s;
            cursor: pointer;
            letter-spacing: 0.025em;
        }

        .btn-register:hover {
            background: var(--secondary-color);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
            font-weight: 400;
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        .form-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.875rem;
            border: 1px solid #fecaca;
            text-align: left;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 14px;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
            }

            .register-header h1 {
                font-size: 1.375rem;
            }

            .form-control {
                height: 44px;
                padding-left: 40px;
            }

            .input-icon i {
                font-size: 14px;
                left: 14px;
            }

            .btn-register {
                padding: 11px 0;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <h1>Daftar Akun Baru</h1>
                <p>Buat akun untuk mulai menggunakan sistem</p>
            </div>
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                
                <!-- Input Nama -->
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input
                            type="text"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            name="nama"
                            placeholder="Masukkan nama lengkap Anda"
                            value="{{ old('nama') }}"
                            required
                        />
                    </div>
                    @error('nama')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Kontak -->
                <div class="form-group">
                    <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                    <div class="input-icon">
                        <i class="fas fa-phone"></i>
                        <input
                            type="text"
                            class="form-control @error('kontak') is-invalid @enderror"
                            id="kontak"
                            name="kontak"
                            placeholder="Masukkan nomor telepon"
                            value="{{ old('kontak') }}"
                            required
                        />
                    </div>
                    @error('kontak')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Username -->
                <div class="form-group">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <div class="input-icon">
                        <i class="fas fa-at"></i>
                        <input
                            type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            id="username"
                            name="username"
                            placeholder="Buat username unik"
                            value="{{ old('username') }}"
                            required
                        />
                    </div>
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Buat password yang kuat"
                            required
                        />
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password Anda"
                            required
                        />
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
                <a href="{{ url('/login') }}" class="back-link">Sudah punya akun? Masuk di sini</a>
            </form>
            <div class="form-footer">
                &copy; 2024 Sistem E-Commerce. Hak Cipta Dilindungi.
            </div>
        </div>
    </div>

    <script>
        // Menambahkan efek interaktif pada input
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');

            inputs.forEach(input => {
                // Efek saat input aktif
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });

                // Cek jika input sudah memiliki nilai saat halaman dimuat
                if (input.value !== '') {
                    input.parentElement.classList.add('focused');
                }
            });
        });

        // Fungsi untuk toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleButton = passwordField.nextElementSibling;
            const icon = toggleButton.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Validasi konfirmasi password
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                document.getElementById('password').focus();
            }
        });
    </script>
</body>
</html>