<?php
// --- Certificate of Low Income Template ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Low Income</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0.5in;
            font-size: 12pt; /* Standard document font size */
        }
        .certificate-container {
            border: 2px solid black;
            padding: 0.5in;
            width: 100%; /* Make it responsive */
            max-width: 8.5in; /* Set maximum width */
            min-height: 11in; /* Set minimum height */
            margin: auto;
            position: relative;
            box-sizing: border-box; /* Include padding in width calculation */
        }

        /* --- Header Section Styling (Barangay Info) --- */
        .header {
            text-align: center;
            margin-bottom: 0.2in;
        }
        .header .logo-left {
            width: 90px; /* Adjust logo size as needed */
            height: auto;
            position: absolute;
            top: 0.6in;
            left: 0.6in;
        }
        .header .logo-right {
            width: 90px; /* Adjust logo size as needed */
            height: auto;
            position: absolute;
            top: 0.6in;
            right: 0.6in;
        }
        .header-text p {
            margin: 0;
            font-size: 12pt;
        }
        
        .header-text h1 { /* Region */
            font-size: 14pt;
            margin: 5px 0;
            font-weight: bold;
        }

        .office-name {
            font-size: 16pt;
            font-weight: bold;
            margin-top: 20px;
            padding-bottom: 5px;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            display: inline-block;
        }

        /* --- Certificate Title Styling --- */
        .title {
            text-align: center;
            font-size: 24pt;
            font-weight: bold;
            margin-top: 0.3in;
            margin-bottom: 0.3in;
            text-transform: uppercase;
            font-family: 'Arial Black', Gadget, sans-serif;
        }

        /* --- Main Body Content Styling --- */
        .body-content {
            text-align: justify;
            line-height: 1.6; /* Adjusted line spacing */
            margin-bottom: 0.3in;
        }
        .body-content p {
            margin: 0.15in 0; /* Adjusted paragraph spacing */
        }
        .salutation {
            font-weight: bold;
            margin-bottom: 0.2in;
        }

        /* --- Signature Section Styling --- */
        .certified-by {
            margin-top: 1in; /* More space before signature area */
            text-align: center; /* Center the "Certified by:" text */
        }

        .signature-block {
            width: 40%;
            margin-left: 60%; /* Position on the right side */
            text-align: center;
            margin-top: 20px; /* Add some space after "Certified by:" */
        }

        .signature-name {
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
        }
        .official-title {
            font-size: 12pt;
        }

        /* --- Watermark/Background Logo --- */
        .watermark-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px; /* Increased size for larger watermark */
            height: auto;
            opacity: 0.1; /* Very transparent */
            z-index: -1; /* Behind all content */
            pointer-events: none; /* Don't interfere with text selection */
        }

        /* --- Print Styles --- */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .certificate-container {
                border: none !important;
                background: white !important;
                box-shadow: none !important;
                margin: 0;
                padding: 0.5in;
                width: 100%;
                max-width: none;
                min-height: auto;
            }
            
            .office-name {
                border-top: 2px solid black !important;
                border-bottom: 2px solid black !important;
                background: white !important;
            }
            
            /* Ensure watermark prints properly and is visible */
            .watermark-logo {
                opacity: 0.1 !important; /* Reduced visibility but still printable */
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                filter: grayscale(0%) !important; /* Ensure colors print */
                display: block !important; /* Force display */
                visibility: visible !important; /* Force visibility */
                z-index: 0 !important; /* Bring slightly forward but still behind text */
            }
            
            /* Remove any backgrounds but keep content clean */
            *, *::before, *::after {
                background: white !important;
                background-color: white !important;
                box-shadow: none !important;
                border: none !important; /* Remove all borders except specific ones */
            }
            
            /* Specifically target common elements that might have backgrounds */
            .header, .header-text, .title, .body-content, .certified-by, .signature-block,
            p, div, span, h1, h2, h3, h4, h5, h6 {
                background: white !important;
                background-color: white !important;
                border: none !important;
            }
            
            /* Keep only essential borders */
            .office-name {
                border-top: 2px solid black !important;
                border-bottom: 2px solid black !important;
            }
            
            /* Force all text to be black */
            * {
                color: black !important;
            }
            
            /* Remove page margins and hide page title */
            @page {
                margin: 0.5in;
                background: white;
                /* Hide browser page title/header */
                @top-left { content: ""; }
                @top-center { content: ""; }
                @top-right { content: ""; }
                @bottom-left { content: ""; }
                @bottom-center { content: ""; }
                @bottom-right { content: ""; }
            }
            
            /* Hide any browser-generated headers/footers */
            body::before,
            body::after {
                display: none !important;
            }
        }

    </style>
</head>
<body>

    <div class="certificate-container">
        <!-- Watermark/Background Logo -->
        <?php if (!empty($certificate_data['barangay_logo_path']) && file_exists($certificate_data['barangay_logo_path'])): ?>
            <img src="<?php echo html_escape($certificate_data['barangay_logo_path']); ?>" alt="Barangay Watermark" class="watermark-logo">
        <?php endif; ?>
        
        <div class="header">
            <?php if (!empty($certificate_data['municipality_logo_path']) && file_exists($certificate_data['municipality_logo_path'])): ?>
                <img src="<?php echo html_escape($certificate_data['municipality_logo_path']); ?>" alt="Midsayap Logo" class="logo-left">
            <?php endif; ?>
            <div class="header-text">
                <p>Republic of the Philippines</p>
                <h1>REGION XII</h1>
                <p>Province of Cotabato</p>
                <p>Municipality of Midsayap</p>
                <p><b>Barangay Central Glad</b></p>
            </div>
            <?php if (!empty($certificate_data['barangay_logo_path']) && file_exists($certificate_data['barangay_logo_path'])): ?>
                <img src="<?php echo html_escape($certificate_data['barangay_logo_path']); ?>" alt="Barangay Logo" class="logo-right">
            <?php endif; ?>
            
            <div class="office-name">
                OFFICE OF THE BARANGAY CAPTAIN
            </div>
        </div>

        <div class="title">
            LOW-INCOME CERTIFICATION
        </div>

        <div class="body-content">
            <p class="salutation underline">TO WHOM IT MAY CONCERN:</p>
            
            <p style="text-indent: 0.5in;" class="underline">THIS IS TO CERTIFY that <span style="font-weight:bold;"><?php echo html_escape($certificate_data['resident_name']); ?></span> of legal age, <?php echo html_escape($certificate_data['gender']); ?>/<?php echo html_escape($certificate_data['resident_civil_status']); ?>, is a bonafide resident of Barangay Central Glad, Midsayap, Cotabato.</p>

            <p style="text-indent: 0.5in;" class="underline">THIS IS TO FURTHER CERTIFY that he/she belongs to low income family.</p>

            <p style="text-indent: 0.5in;" class="underline">This Low-Income Certification is being issued upon his request for <?php echo html_escape($certificate_data['purpose'] ?? '________________________________'); ?> and whatever legal purpose that will serve him best.</p>
            
            <p style="text-indent: 0.5in;" class="underline">Issued this <?php echo html_escape($certificate_data['day']); ?> day of <?php echo html_escape($certificate_data['month']); ?>, <?php echo html_escape($certificate_data['year']); ?> at the office of the Barangay Captain, Barangay Central Glad, Midsayap, Cotabato.</p>
        </div>

        <div class="certified-by">
            <p class="underline">Certified by:</p>
            <div class="signature-block">
                <p class="signature-name underline"><?php echo html_escape($certificate_data['punong_barangay']); ?></p>
                <p class="official-title underline">Punong Barangay</p>
            </div>
        </div>
        
    </div>

</body>
</html> 