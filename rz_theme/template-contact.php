<?php
/**
 * template-contact.php
 *
 * Template Name: Contact Page
 */
?>

<?php
    $errors = array();
    $is_error = false;

    $error_name = __( 'Please enter your name.', 'rz_theme' );
    $error_email = __( 'Please enter a valid email address.', 'rz_theme' );
    $error_message = __( 'Please enter the message.', 'rz_theme' );

    // Get the posted variables and validate them.
    if ( isset( $_POST['is_submitted'] ) ) {
        $name = $_POST['c_name'];
        $email = $_POST['c_email'];
        $message = $_POST['c_message'];

        // Check the name.
        if ( ! rz_theme_validate_length( $name, 2 ) ) {
            $is_error = true;
            $errors['error_name'] = $error_name;
        }

        // Check the email.
        if ( ! is_email( $email ) ) {
            $is_error = true;
            $errors['error_email'] = $error_email;
        }

        // Check the message.
        if ( ! rz_theme_validate_length( $message, 2 ) ) {
            $is_error = true;
            $errors['error_message'] = $error_message;
        }

        // If there's no error, send email.
        if ( ! $is_error ) {
            // get admin email
            $email_receiver = get_option( 'admin_email' );

            $email_subject = sprintf( __( 'You have been contacted by %s', 'rz_theme' ), $name );
            $email_body = sprintf( __( 'You have been contacted by %1$s. Their message is:', 'rz_theme' ),
                $name ) . PHP_EOL . PHP_EOL;
            $email_body .= $message . PHP_EOL . PHP_EOL;
            $email_body .= sprintf( __( 'You can contact %1$s via email at %2$s', 'rz_theme' ),
                $name, $email
            );
            $email_body .= PHP_EOL . PHP_EOL;

            $email_headers[] = "Reply-To: $email" . PHP_EOL;

            $email_is_sent = wp_mail( $email_receiver, $email_subject, $email_body, $email_headers );

        }
    }
?>

<?php get_header(); ?>

    <div class="main-content col-md-8" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- Article header -->
                <header class="entry-header"><?php
                // If the post has a thumbnail and it's not password protected
                // then display the thumbnail
                    if ( the_post_thumbnail() && ! post_password_required() ) : ?>
                        <figure class="entry-thumbnail"><?php the_post_thumbnail() ?></figure>
                    <?php endif; ?>
                    
                    <h1><?php the_title(); ?></h1>
                </header>

                <!-- Article Content -->
                <div class="entry-content">
                    <?php if ( isset( $email_is_sent ) && $email_is_sent ) : ?>
                        <div class="alert alert-success">
                            <?php _e( 'Your message has been sucessfully sent, thank you!', 'rz_theme' ); ?>
                        </div>
                    <?php else : ?>

                        <?php the_content(); ?>

                        <?php if ( isset( $is_error ) ) : ?>
                            <div class="alert alert-danger">
                                <?php _e( 'Sorry, it seems there was an error.', 'rz_theme' ) ?>
                            </div><!-- end alert -->
                        <?php endif; ?>
                    <?php endif; ?>
                </div><!-- end entry-content -->

                <!-- Contact form -->
                <form action="<?php the_permalink(); ?>" id="contact-form" method="POST" role="form">

                    <div class="form-group <?php if ( isset( $errors['error_name'] ) ) echo 'has-error'; ?>">
                        <label for="contact-name" class="control-label">
                            <span class="required">*</span>
                            <?php _e( 'Name:', 'rz_theme' ); ?>
                        </label>
                        <input type="text" class="form-control" name="c_name" id="contact-name" value="<?php if ( isset( $_POST['c_name'] ) ) { echo $_POST['c_name']; } ?>">
                        <?php if ( isset( $errors['error_name'] ) ) : ?>
                            <p class="help-block"><?php echo $errors['error_name']; ?></p>
                        <?php endif; ?>
                    </div><!-- end form-group -->

                    <div class="form-group <?php if ( isset( $errors['error_email'] ) ) echo 'has-error'; ?>">
                        <label for="contact-email" class="control-label">
                            <span class="required">*</span>
                            <?php _e( 'Email Address:', 'rz_theme' ); ?>
                        </label>
                        <input type="email" class="form-control" name="c_email" id="contact-email" value="<?php if ( isset( $_POST['c_email'] ) ) { echo $_POST['c_email']; } ?>">
                        <?php if ( isset( $errors['error_email'] ) ) : ?><p class="help-block"></p>
                        <?php endif; ?>
                    </div><!-- end form-group -->

                    <div class="form-group <?php if ( isset( $errors['error_message'] ) ) echo 'has-error'; ?>">
                        <label for="contact-message" class="control-label">
                            <span class="required">*</span>
                            <?php _e( 'Your Message:', 'rz_theme' ); ?>
                        </label>
                        <textarea class="form-control" name="c_message" id="contact-message" cols="30" rows="10"><?php if ( isset( $_POST['c_message'] ) ) { echo $_POST['c_message']; } ?></textarea>
                        <?php if ( isset( $errors['error_message'] ) ) : ?>
                            <p class="help-block"><?php echo $errors['error_message']; ?></p>
                        <?php endif; ?>
                    </div><!-- end form-group -->

                    <input type="hidden" name="is_submitted" id="is-submitted" value="true">
                    <button type="submit" class="btn btn-default"><?php _e( 'Send message', 'rz_theme' ); ?></button>
                </form><!--end form -->

            </article>
        <?php endwhile; ?>
    </div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>