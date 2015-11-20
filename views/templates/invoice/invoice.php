<?php

/**
 * DO NOT EDIT THIS FILE! Instead customize it via a theme override.
 *
 * Any edit will not be saved when this plugin is upgraded. Not upgrading will prevent you from receiving new features,
 * limit our ability to support your site and potentially expose your site to security risk that an upgrade has fixed.
 *
 * https://sproutapps.co/support/knowledgebase/sprout-invoices/customizing-templates/
 *
 * You find something that you're not able to customize? We want your experience to be awesome so let support know and we'll be able to help you.
 *
 */

do_action( 'pre_si_invoice_view' ); ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php si_head(); ?>
		<meta name="robots" content="noindex, nofollow" />
	</head>

	<body id="invoice" <?php body_class(); ?>>

		<div id="outer_doc_wrap">

			<?php si_display_messages(); ?>
			<?php do_action( 'si_invoice_outer_doc_wrap' ) ?>
			
			<?php if ( si_get_invoice_balance() ) : ?>
				<?php do_action( 'si_payments_pane' ); ?>
			<?php endif ?>

			<div id="doc_header_wrap" class="sticky_header">
				<header id="header_title">
					
					<span class="header_id"><?php printf( esc_html__( 'Invoice %s', 'sprout-invoices' ), intval( si_get_invoice_id() ) ) ?></span>
					
					<div id="doc_actions">

						<?php do_action( 'si_doc_actions_pre' ) ?>

						<?php if ( si_get_invoice_balance() && 'write-off' !== si_get_invoice_status() ) : ?>
							
							<?php
								$payment_string = ( si_has_invoice_deposit() ) ? __( 'Pay Deposit', 'sprout-invoices' ) : __( 'Pay Invoice', 'sprout-invoices' );
								?>
							<?php do_action( 'si_invoice_payment_button', get_the_ID(), $payment_string ) ?>
							
						<?php endif ?>

						<?php do_action( 'si_doc_actions' ) ?>

					</div><!-- #doc_actions -->

				</header><!-- #header_title -->

			</div><!-- #doc_header_wrap -->

			<div id="document_wrap">

				<div id="doc">

					<section id="header_wrap" class="clearfix">

						<div id="header_logo" class="clearfix">
							
							<header role="banner">
								<div class="header_info">
									<h2 class="doc_type"><?php esc_html_e( 'Invoice', 'sprout-invoices' ) ?></h2>
									<p class="title"><?php the_title() ?></p>
								</div>

								<h1 id="logo">
									<?php if ( get_theme_mod( 'si_logo' ) ) : ?>
										<img src="<?php echo esc_url( get_theme_mod( 'si_logo', si_doc_header_logo_url() ) ); ?>" alt="document logo" >
									<?php else : ?>
										<img src="<?php echo esc_url( si_doc_header_logo_url() ) ?>" alt="document logo" >
									<?php endif; ?>
								</h1>	
							</header><!-- /header -->

							<?php if ( 'write-off' === si_get_invoice_status() ) : ?>
								<span id="status" class="void"><span class="inner_status"><?php esc_html_e( 'Void', 'sprout-invoices' ) ?></span></span>
							<?php elseif ( ( si_get_invoice_balance() > 0.00 ) && ( si_get_invoice_balance() <= si_get_invoice_payments_total() ) ) : ?>
								<span id="status" class="void"><span class="inner_status"><?php esc_html_e( 'Payment Pending', 'sprout-invoices' ) ?></span></span>
							<?php elseif ( ! si_get_invoice_balance() ) : ?>
								<span id="status" class="paid"><span class="inner_status"><?php esc_html_e( 'Paid', 'sprout-invoices' ) ?></span></span>
							<?php elseif ( 'temp' === si_get_invoice_status() ) : ?>
								<span id="status" class="void"><span class="inner_status"><?php esc_html_e( 'TEMP', 'sprout-invoices' ) ?></span></span>
							<?php endif ?>
						</div><!-- #header_logo -->

						<div id="vcards">
							<?php do_action( 'si_document_vcards_pre' ) ?>
							<dl id="doc_address_info">
								<dl class="from_addy">
									<dt>
										<span class="dt_heading"><?php esc_html_e( 'From', 'sprout-invoices' ) ?></span>
									</dt>
									<dd>
										<b><?php si_company_name() ?></b> 
										<?php si_doc_address() ?>
									</dd>
								</dl>
								<?php if ( si_get_invoice_client_id() ) : ?>
									<dl class="client_addy">
										<dt>
											<span class="dt_heading"><?php esc_html_e( 'To', 'sprout-invoices' ) ?></span>
										</dt>
										<dd>
											<b><?php echo get_the_title( si_get_invoice_client_id() ) ?></b>
											
											<?php do_action( 'si_document_client_addy' ) ?>
											 
											<?php si_client_address( si_get_invoice_client_id() ) ?>
										</dd>
									</dl>
								<?php endif ?>
							</dl><!-- #doc_address_info -->
							<?php do_action( 'si_document_vcards' ) ?>
						</div><!-- #vcards -->
						
						<div class="doc_details clearfix">
							<?php do_action( 'si_document_details_pre' ) ?>

							<dl class="date">
								<dt><span class="dt_heading"><?php esc_html_e( 'Date', 'sprout-invoices' ) ?></span></dt>
								<dd><?php si_invoice_issue_date() ?></dd>
							</dl>

							<?php if ( si_get_invoice_id() ) : ?>
								<dl class="invoice_number">
									<dt><span class="dt_heading"><?php esc_html_e( 'Invoice Number', 'sprout-invoices' ) ?></span></dt>
									<dd><?php si_invoice_id() ?></dd>
								</dl>
							<?php endif ?>

							<?php if ( si_get_invoice_po_number() ) : ?>
								<dl class="invoice_po_number">
									<dt><span class="dt_heading"><?php esc_html_e( 'PO Number', 'sprout-invoices' ) ?></span></dt>
									<dd><?php si_invoice_po_number() ?></dd>
								</dl>
							<?php endif ?>

							<?php if ( si_get_invoice_due_date() ) : ?>
								<dl class="date">
									<dt><span class="dt_heading"><?php esc_html_e( 'Invoice Due', 'sprout-invoices' ) ?></span></dt>
									<dd><?php si_invoice_due_date() ?></dd>
								</dl>
							<?php endif ?>

							<?php do_action( 'si_document_details_totals' ) ?>

							<?php if ( si_has_invoice_deposit() ) : ?>
								<dl class="doc_total_with_deposit">
									<dt><span class="dt_heading"><?php esc_html_e( 'Invoice Total', 'sprout-invoices' ) ?></span></dt>
									<dd><?php sa_formatted_money( si_get_invoice_total() ) ?></dd>
								</dl>

								<dl class="doc_total">
									<dt><span class="dt_heading"><?php esc_html_e( 'Deposit Total', 'sprout-invoices' ) ?></span></dt>
									<dd><?php sa_formatted_money( si_get_invoice_deposit() ) ?></dd>
								</dl>
							<?php else : ?>
								<dl class="doc_total">
									<dt><span class="dt_heading"><?php esc_html_e( 'Invoice Total', 'sprout-invoices' ) ?></span></dt>
									<dd><?php sa_formatted_money( si_get_invoice_total() ) ?></dd>
								</dl>
							<?php endif ?>

							<dl class="doc_total doc_balance">
								<dt><span class="dt_heading"><?php esc_html_e( 'Balance', 'sprout-invoices' ) ?></span></dt>
								<dd><?php sa_formatted_money( si_get_invoice_balance() ) ?></dd>
							</dl>

							<?php do_action( 'si_document_details' ) ?>
						</div><!-- #doc_details -->

					</section>

					<section id="doc_line_items_wrap" class="clearfix">
					
						<div id="doc_line_items" class="clearfix">
							
							<?php do_action( 'si_doc_line_items', get_the_id() ) ?>

						</div><!-- #doc_line_items -->

					</section>

					<section id="doc_notes">
						<?php if ( strlen( si_get_invoice_notes() ) > 1 ) : ?>
						<?php do_action( 'si_document_notes' ) ?>
						<div id="doc_notes">
							<h2><?php esc_html_e( 'Notes', 'sprout-invoices' ) ?></h2>
							<?php si_invoice_notes() ?>
						</div><!-- #doc_notes -->
						
						<?php endif ?>

						<?php if ( strlen( si_get_invoice_terms() ) > 1 ) : ?>
						<?php do_action( 'si_document_terms' ) ?>
						<div id="doc_terms">
							<h2><?php esc_html_e( 'Terms', 'sprout-invoices' ) ?></h2>
							<?php si_invoice_terms() ?>
						</div><!-- #doc_terms -->
						
						<?php endif ?>

					</section>

				</div><!-- #doc -->

				<div id="footer_wrap">
					<?php do_action( 'si_document_footer' ) ?>
					<aside>
						<ul class="doc_footer_items">
							<li class="doc_footer_item">
								<?php printf( '<strong>%s</strong> %s', '<div class="dashicons dashicons-admin-site"></div>', make_clickable( home_url() ) ) ?>
							</li>
							<?php if ( si_get_company_email() ) : ?>
								<li class="doc_footer_item">
									<?php printf( '<strong>%s</strong> %s', '<div class="dashicons dashicons-email-alt"></div>', make_clickable( si_get_company_email() ) ) ?>
								</li>
							<?php endif ?>
						</ul>
					</aside>
				</div><!-- #footer_wrap -->
			
			</div><!-- #document_wrap -->

		</div><!-- #outer_doc_wrap -->
		
		<div id="doc_history">
			<?php do_action( 'si_document_history' ) ?>
			<?php foreach ( si_doc_history_records() as $item_id => $data ) : ?>
				<dt>
					<span class="history_status <?php echo esc_attr( $data['status_type'] ); ?>"><?php echo esc_attr( $data['type'] ); ?></span><br/>
					<span class="history_date"><?php echo esc_html( date( get_option( 'date_format' ).' @ '.get_option( 'time_format' ), strtotime( $data['post_date'] ) ) ) ?></span>
				</dt>

				<dd>
					<?php if ( SI_Notifications::RECORD === $data['status_type'] ) : ?>
						<p>
							<?php echo esc_html( $update_title ) ?>
							<br/><a href="#TB_inline?width=600&height=380&inlineId=notification_message_<?php echo (int) $item_id ?>" id="show_notification_tb_link_<?php echo (int) $item_id ?>" class="thickbox si_tooltip notification_message" title="<?php esc_html_e( 'View Message', 'sprout-invoices' ) ?>"><?php esc_html_e( 'View Message', 'sprout-invoices' ) ?></a>
						</p>
						<div id="notification_message_<?php echo (int) $item_id ?>" class="cloak">
							<?php echo wpautop( $data['content'] ) ?>
						</div>
					<?php elseif ( SI_Invoices::VIEWED_STATUS_UPDATE === $data['status_type'] ) : ?>
						<p>
							<?php echo $data['update_title']; ?>
						</p>
					<?php else : ?>
						<?php echo wpautop( $data['content'] ) ?>
					<?php endif ?>
					
				</dd>
			<?php endforeach ?>
		</div><!-- #doc_history -->

		<div id="footer_credit">
			<?php do_action( 'si_document_footer_credit' ) ?>
			<!--<p><?php esc_html_e( 'Powered by Sprout Invoices', 'sprout-invoices' ) ?></p>-->
		</div><!-- #footer_messaging -->

	</body>
	<?php do_action( 'si_document_footer' ) ?>
	<?php si_footer() ?>
	<!-- Template Version 9.2 -->
</html>
<?php do_action( 'invoice_viewed' ) ?>