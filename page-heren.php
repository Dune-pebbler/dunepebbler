<?php

/**
 * Template Name: Heren van spui placeholder
 */

 // Haal het huidige post ID op
$post_id = get_the_ID();

// Haal de URL van de post thumbnail (logo) op
$logo_url = get_the_post_thumbnail_url($post_id, 'full');

// Als er geen thumbnail is, gebruik dan een standaard afbeelding of laat het leeg
if (!$logo_url) {
    $logo_url = ''; // Of zet hier de URL van een standaard logo
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Launch Aankondiging</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #C05746;
            font-family: 'Inter', sans-serif;
        }
        .content {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 20px;
        }
        .logo {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-12">
                <?php if ($logo_url): ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="Logo" class="logo">
                <?php endif; ?>
                <h1>Eind juli 2024 wordt deze website gelanceerd</h1>
            </div>
        </div>
    </div>
</body>
</html>
