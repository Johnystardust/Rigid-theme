<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<div class="container-fluid custom-404-header">
    <div class="container">
        <div class="row text-center custom-404-header-title">
            <h1 class="no-margin">404 - Pagina niet gevonden</h1>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container error-404">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>404 - Error</h2>
                <p>De pagina waar u naar op zoek bent bestaat mogelijk niet meer, is verplaatst of is tijdelijk niet beschikbaar</p>
                <br/>
                <p>
                    <strong>Wat kunt u doen:</strong><br/><br/>
                    Controleer uw spelling.<br/>
                    Ga terug naar de <a href="<?php echo get_home_url(); ?>">home pagina</a>.<br/>
                    Klik op <a href="javascript:javascript:history.go(-1)">terug</a> in uw browser.
                </p>
            </div>
        </div>
    </div>
</div>

<?php get_template_part( 'partials/quote' ); ?>

<?php get_footer(); ?>
