<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php'; // Adjust path to config.php

// Determine the current page to set the active class in the sidebar
$current_page = basename($_SERVER['PHP_SELF']);

// Fetch system settings
$system_settings = [];
$settings_query = "SELECT setting_key, setting_value FROM system_settings";
$settings_result = mysqli_query($link, $settings_query);
if ($settings_result) {
    while ($row = mysqli_fetch_assoc($settings_result)) {
        $system_settings[$row['setting_key']] = $row['setting_value'];
    }
}

// Get barangay name and logo path
$barangay_name = $system_settings['barangay_name'] ?? 'Barangay Management System';
$logo_path = !empty($system_settings['barangay_logo_path']) && file_exists($system_settings['barangay_logo_path']) 
    ? $system_settings['barangay_logo_path'] 
    : rtrim(dirname($_SERVER['PHP_SELF']), '/\\\\') . '/images/barangay-logo.png';

// Get user role from session
$user_role = $_SESSION['role'] ?? 'staff'; // Default to 'staff' if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? html_escape($page_title) . ' - ' : ''; ?>Barangay Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ?: ''; ?>/styles.css"> <!-- Dynamic path for styles.css -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar" id="sidebar">
                <div class="text-center py-4 sidebar-header">
                    <img src="<?php echo $logo_path; ?>" alt="<?php echo html_escape($barangay_name); ?>" class="sidebar-logo">
                    <h5 class="mt-2 text-white"><?php echo html_escape($barangay_name); ?></h5>
                </div>
                <div class="sidebar-menu">
                    <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a class="nav-link <?php echo ($current_page == 'manage_residents.php') ? 'active' : ''; ?>" href="manage_residents.php">
                        <i class="fas fa-users"></i> Manage Residents
                    </a>
                    <a class="nav-link <?php echo ($current_page == 'purok_details.php') ? 'active' : ''; ?>" href="purok_details.php">
                        <i class="fas fa-chart-bar"></i> Purok Details
                    </a>

                    <?php if ($user_role === 'Barangay Secretary'): ?>
                    <a class="nav-link <?php echo ($current_page == 'manage_puroks.php') ? 'active' : ''; ?>" href="manage_puroks.php">
                        <i class="fas fa-map-marked-alt"></i> Manage Puroks
                    </a>
                    <a class="nav-link <?php echo ($current_page == 'manage_households.php') ? 'active' : ''; ?>" href="manage_households.php">
                        <i class="fas fa-home"></i> Manage Households
                    </a>
                    <a class="nav-link <?php echo ($current_page == 'manage_officials.php') ? 'active' : ''; ?>" href="manage_officials.php">
                        <i class="fas fa-user-tie"></i> Barangay Officials
                    </a>
                    <a href="sms_blast.php" class="<?php echo ($current_page == 'sms_blast.php') ? 'active' : ''; ?>">
                        <i class="fas fa-sms"></i> SMS Blast
                    </a>
                    <a href="manage_certificates.php" class="<?php echo ($current_page == 'certificates.php' || $current_page == 'manage_certificates.php' || $current_page == 'issue_certificate_form.php') ? 'active' : ''; ?>">
                        <i class="fas fa-certificate"></i> Certificate
                    </a>
                    <a href="history_log.php" class="<?php echo ($current_page == 'history_log.php') ? 'active' : ''; ?>">
                        <i class="fas fa-history"></i> History Log
                    </a>
                    <?php endif; ?>

                    <a href="system_settings.php" class="<?php echo ($current_page == 'system_settings.php') ? 'active' : ''; ?>">
                        <i class="fas fa-cog"></i> System Settings
                    </a>
                    <a href="logout.php" class="sidebar-logout-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Main Content Start -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
