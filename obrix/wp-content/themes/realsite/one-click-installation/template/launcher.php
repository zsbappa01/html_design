<?php $inactive_plugins = aviators_launcher_has_inactive_plugins(); ?>

<div class="wrap">
  <h2><?php echo __('One Click Installation', 'realia'); ?></h2>

    <?php if ( $inactive_plugins == true ) : ?>
    <div class="error">
        <h3><?php echo __('Please activate following plugins before installation:', 'realia'); ?></h3>
        <ul>
            <?php foreach ( $inactive_plugins as $inactive_plugin ) : ?>
            <li><a href="<?php echo esc_attr( $inactive_plugin['url'] ); ?>"><?php echo esc_attr( $inactive_plugin['title'] ); ?></a></li>
            <?php endforeach; ?>
        </ul>
        <p>&larr; <a href="<?php echo admin_url( 'plugins.php'); ?>"><?php echo __( 'Back to Plugins', 'realia' ); ?></a></p>
    </div>
    <?php endif; ?>

  <div class="updated">
    <?php echo __('<p>If you are stucked on one step please check <strong>max_execution_time</strong> in <strong>php.ini</strong> and set higher value.</p><code>max_execution_time = 60</code>', 'realia'); ?><br/>

    <p>
      <?php echo __('Note that this process might overwrite your existing installation settings, use only on <strong>fresh</strong> installations!', 'realia'); ?><br/>
    </p>
    <p>
      <?php echo __('Note that some steps might execute for several minutes, do not reload this page, until the process is done!', 'realia'); ?><br/>
    </p>
    <p>
      <?php echo __('Do not run this installation multiple times, all the settings will be reverted to defaults!', 'realia'); ?>
    </p>
  </div>

  <?php if ( $inactive_plugins == false ) : ?>
    <div id="start">
      <a class="btn" data-steps="<?php print $step_ids; ?>" href="#">
        <?php echo __('Start Demo Setup', 'realia'); ?>
      </a>
    </div>
  <?php endif; ?>

  <?php foreach ($steps as $id => $step): ?>
    <div class="postbox launcher-step lock" id="<?php echo esc_attr( $id ) ?>-step">
      <h3 class="title">
        <?php echo esc_attr( $step['title'] ); ?>
        <a href="#" class="show-report"><?php echo __( 'Show Report', 'realia' ); ?></a>
      </h3>
      <div class="report"></div>
    </div>
  <?php endforeach; ?>
</div>


<script>
  jQuery('.show-report').on('click', function (e) {
    jQuery('.report', jQuery(this).parent().parent()).slideDown();
    e.preventDefault();
  });

  jQuery('#start a').click(function (e) {
    var steps = jQuery(this).data('steps').split(',');

    if (steps.length) {
      step = steps.shift();
      processLauncherStep(step, steps);
    }
    e.preventDefault();
  });

  function processLauncherStep(step, steps) {
    var stepID = '#' + step + '-step';
    jQuery(stepID).removeClass('lock');
    jQuery(stepID).addClass('lock-open');

    jQuery.ajax({
      url: "<?php print home_url(); ?>/wp-admin/admin.php?page=launcher&action=process&step=" + step
    }).done(function (data) {
        try {
            var messages = jQuery.parseJSON(data);
        } catch(e) {
            // Server result is not able to parse to JSON
        }

        jQuery(stepID).removeClass('lock-open');
        jQuery(stepID).addClass('done');

        jQuery.ajax({
          url: "<?php print home_url(); ?>/wp-admin/admin.php?page=launcher&action=report&step=" + step
        }).done(function (report) {
            jQuery(".report", stepID).append(report);
            if (steps.length) {
              step = steps.shift();
              processLauncherStep(step, steps);
            }
          });
      });
  }
</script>

<style>
  #start a {
    border-radius: 3px;
    margin: 30px 0px !important;
    float: none;
    display: inline-block;
    text-decoration: none;
    background-color: #27caae;
    color: #fff;
    padding: 15px 25px;
    font-size: 25px;
    transition: all linear .2s;
  }

  #start a:hover {
      background-color: #32b19e;
  }

  .launcher-step {
    background-color: #fff;
    border: 0px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
    padding: 6px 12px;
  }

  .launcher-step .report  {
    display: none;
    background-color: #eeeeee;
    padding: 15px;
    border: 1px solid #e4e4e4;
  }

  .launcher-step h3 {
      background-size: 24px 24px !important;
      font-size: 12px;
      font-weight: normal;
      margin: 0px;
      padding: 0px;
  }

  .launcher-step .show-report  {
    float: right;
    font-size: 12px;
    display: none;
  }
  .launcher-step .title {
    text-indent: 40px;
    padding: 10px 0px;
  }

  .launcher-step.done .show-report {
    display: block;
  }
  .launcher-step.done .title {
    background: url('<?php print AVIATORS_LAUNCHER_URI ?>/assets/img/checked.png') no-repeat left center;
  }

  .launcher-step.lock .title {
    background: url('<?php print AVIATORS_LAUNCHER_URI ?>/assets/img/unchecked.png') no-repeat left center;
  }

  .launcher-step.lock-open .title {
    background: url('<?php print AVIATORS_LAUNCHER_URI ?>/assets/img/preloader1.gif') no-repeat left center;
  }

  ul {
      padding-left: 30px;
  }

  ul li {
      list-style-type: disc;
  }


</style>
