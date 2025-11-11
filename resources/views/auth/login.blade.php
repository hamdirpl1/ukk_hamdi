<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Sistem E-Commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a56db;
            --secondary-color: #0d47a1;
            --accent-color: #2563eb;
            --light-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease-out;
        }

        .login-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 40px 35px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 0.95rem;
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
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 18px;
            transition: color 0.3s;
        }

        .form-control {
            border-radius: 10px;
            background: var(--light-bg);
            border: 2px solid #e2e8f0;
            padding: 12px 15px 12px 45px;
            height: 50px;
            color: var(--text-dark);
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            background: var(--white);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            color: var(--text-dark);
        }

        .form-control:focus + i {
            color: var(--accent-color);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--white);
            border-radius: 10px;
            font-weight: 600;
            padding: 14px 0;
            margin-top: 10px;
            width: 100%;
            border: none;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--accent-color);
        }

        .form-footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 25px;
            }

            .login-header h1 {
                font-size: 1.6rem;
            }

            .form-control {
                height: 45px;
                padding-left: 40px;
            }

            .input-icon i {
                font-size: 16px;
                left: 12px;
            }

            .btn-login {
                padding: 12px 0;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1>Login Sistem</h1>
                <p>Masuk ke akun Anda</p>
            </div>
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            placeholder="Masukkan username Anda"
                            value="{{ old('username') }}"
                            required
                        />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password Anda"
                            required
                        />
                    </div>
                </div>
                <button type="submit" class="btn btn-login">Masuk ke Sistem</button>
                <a href="/" class="back-link">Kembali ke Beranda</a>
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
    </script>
</body>
</html>
