<?php
/**
 * Tools
 *
 * @package     Give
 * @subpackage  Admin/Reports
 * @copyright   Copyright (c) 2016, WordImpress
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display the recount stats tools
 *
 * @since       1.5
 * @return      void
 */
function give_tools_recount_stats_display() {

	if ( ! current_user_can( 'manage_give_settings' ) ) {
		return;
	}

	do_action( 'give_tools_recount_stats_before' );
	?>
	<div id="poststuff">
		<div class="postbox">

			<h2 class="hndle ui-sortable-handle"><span><?php _e( 'Recount Stats', 'give' ); ?></span></h2>

			<div class="inside recount-stats-controls">
				<p><?php _e( 'Use these tools to recount stats, delete test transactions, or reset stats.', 'give' ); ?></p>
				<form method="post" id="give-tools-recount-form" class="give-export-form">

					<?php wp_nonce_field( 'give_ajax_export', 'give_ajax_export' ); ?>

					<select name="give-export-class" id="recount-stats-type">
						<option value="0" selected="selected" disabled="disabled"><?php _e( 'Please select an option', 'give' ); ?></option>
						<option data-type="recount-stats" value="Give_Tools_Recount_Income"><?php _e( 'Recalculate Total Donation Income Amount', 'give' ); ?></option>
						<option data-type="recount-form" value="Give_Tools_Recount_Form_Stats"><?php _e( 'Recalculate Income Amount and Donation Counts for a Form', 'give' ); ?></option>
						<option data-type="recount-all" value="Give_Tools_Recount_All_Stats"><?php _e( 'Recalculate Income Amount and Donation Counts for All Forms', 'give' ); ?></option>
						<option data-type="recount-customer-stats" value="Give_Tools_Recount_Customer_Stats"><?php _e( 'Recalculate Donor Statistics', 'give' ); ?></option>
						<option data-type="delete-test-transactions" value="Give_Tools_Delete_Test_Transactions"><?php _e( 'Delete Test Transactions', 'give' ); ?></option>
						<option data-type="reset-stats" value="Give_Tools_Reset_Stats"><?php _e( 'Delete All Data', 'give' ); ?></option>
						<?php do_action( 'give_recount_tool_options' ); ?>
					</select>

					<span id="tools-form-dropdown" style="display: none">
						<?php
						$args = array(
							'name'   => 'form_id',
							'number' => - 1,
							'chosen' => true,
						);
						echo Give()->html->forms_dropdown( $args );
						?>
					</span>

					<input type="submit" id="recount-stats-submit" value="<?php _e( 'Submit', 'give' ); ?>" class="button-secondary"/>

					<br/>

					<span class="give-recount-stats-descriptions">
						<span id="recount-stats"><?php _e( 'Recalculates the overall donation income amount.', 'give' ); ?></span>
						<span id="recount-form"><?php
							printf(
								/* translators: %s: form singular label */
								__( 'Recalculates the donation and income stats for a specific %s.', 'give' ),
								give_get_forms_label_singular( true )
							);
						?></span>
						<span id="recount-all"><?php
							printf(
								/* translators: %s: form plural label */
								__( 'Recalculates the earnings and sales stats for all %s.', 'give' ),
								give_get_forms_label_plural( true )
							);
						?></span>
						<span id="recount-customer-stats"><?php _e( 'Recalculates the lifetime value and donation counts for all donors.', 'give' ); ?></span>
						<?php do_action( 'give_recount_tool_descriptions' ); ?>
						<span id="delete-test-transactions"><?php _e( '<strong>Deletes</strong> all TEST payment records, donors, and related log entries.', 'give' ); ?></span>
						<span id="reset-stats"><?php _e( '<strong>Deletes</strong> ALL transaction records, donors, and related log entries regardless of test or live mode.', 'give' ); ?></span>
					</span>

					<span class="spinner"></span>

				</form>
				<?php do_action( 'give_tools_recount_forms' ); ?>
			</div><!-- .inside -->
		</div><!-- .postbox -->
	</div><!-- #poststuff -->
	<?php
	do_action( 'give_tools_recount_stats_after' );
}

add_action( 'give_reports_tab_tools', 'give_tools_recount_stats_display' );
