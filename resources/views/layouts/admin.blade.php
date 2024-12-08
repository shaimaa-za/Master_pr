<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* تخصيص إعدادات الصفحة بشكل عام */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F9F9F9; /* لون خلفية محايد خفيف */
        }

        /* تخصيص الهيدر */
        header, footer {
            background-color: #D8C9A3; /* لون بيج أنيق */
            color: white;
            text-align: center;
            padding: 20px 0;
            font-family: 'Playfair Display', serif; /* استخدام خط Playfair Display */
            font-weight: 700; /* جعل النص عريض */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* إضافة ظل للنص لجعله بارزًا */
        }

        /* تخصيص الشريط الجانبي */
        .sidebar {
            background-color: #F4E1D2; /* بيج فاتح */
            min-height: 100vh;
            padding: 20px;
            border-right: 2px solid #D8C9A3; /* إضافة حدود ناعمة بين الشريط الجانبي والمحتوى */
        }

        /* تخصيص محتوى الصفحة */
        .content {
            background-color: #FFFFFF; /* خلفية بيضاء نظيفة */
            padding: 3%;
            min-height: 100vh;
        }

        /* تخصيص الروابط في الشريط الجانبي */
        .sidebar a {
            color: #5C5C5C; /* لون داكن محايد */
            text-decoration: none;
            font-weight: bold;
            display: block;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #D8C9A3; /* بيج فاتح عند التمرير */
            color: white;
            padding-left: 20px; /* إضافة حركة لتوسيع المسافة عند التمرير */
        }

        /* تخصيص المحتوى داخل الجدول */
        .table thead {
            background-color: #D8C9A3; /* بيج */
            color: #5C5C5C; /* رمادي داكن */
        }

        .table tbody {
            background-color: #FAF9F1; /* لون بيج خفيف للصفوف */
        }

        /* تخصيص الأزرار */
        .btn-primary {
            background-color: #D8C9A3;
            border-color: #D8C9A3;
            color: #5C5C5C;
        }

        .btn-primary:hover {
            background-color: #5C5C5C;
            border-color: #5C5C5C;
            color: white;
        }

        footer p {
            font-size: 0.875rem;
            margin: 0;
        }

    </style>
</head>
<body>

<header>
    <div class="row">
        <div class="col-md-12">
            <h1>Admin Panel</h1>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <h4>Navigation</h4>
            <ul class="list-unstyled">
                <li><a href="#">Dashboard</a></li>
                <li><a href="{{ route('admin.products.index') }}">Manage Products</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
                <li><a href="{{ route('admin.suppliers.index') }}">Manage Suppliers</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Reviews</a></li>
                <li><a href="#">Shipping & Payments</a></li>
                <li><a href="#">User Management</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>
        <div class="col-md-9 content">
            <!-- Content -->
            @yield('content')
        </div>
    </div>
    <div class="row">
        <footer>
            <p>&copy; 2024 Jewelry & Watches Store. All Rights Reserved.</p>
        </footer>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
