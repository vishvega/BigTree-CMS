<?php
	namespace BigTree;

	$error = "";
	if (isset($_SESSION["bigtree_admin"]["create_user"])) {
		\BigTree::globalizeArray($_SESSION["bigtree_admin"]["create_user"],array("htmlspecialchars"));
		$daily_digest = isset($daily_digest) ? $daily_digest : false;
		unset($_SESSION["bigtree_admin"]["create_user"]);
	} else {
		$email = "";
		$name = "";
		$company = "";
		$daily_digest = "on";
		$level = 0;
	}
?>
<div class="container">
	<form class="module" action="<?=ADMIN_ROOT?>users/create/" method="post">	
		<section>
			<p class="error_message"<?php if (!$error) { ?> style="display: none;"<?php } ?>><?=Text::translate("Errors found! Please fix the highlighted fields before submitting.")?></p>
			<div class="left">
				<fieldset<?php if ($error == "email") { ?> class="form_error"<?php } ?> style="position: relative;">
					<label class="required"><?=Text::translate("Email")?> <small>(<?=Text::translate("Profile images from")?> <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>)</small> <?php if ($error == "email") { ?><span class="form_error_reason"><?=Text::translate("Already In Use")?></span><?php } ?></label>
					<input type="text" class="required email" name="email" autocomplete="off" value="<?=$email?>" tabindex="1" />
					<span class="gravatar"<?php if ($email != "") echo ' style="display: block;"'; ?>><img src="<?=\BigTree::gravatar($email, 36)?>" alt="" /></span>
				</fieldset>
				
				<fieldset<?php if ($error == "password") { ?> class="form_error"<?php } ?>>
					<label class="required"><?=Text::translate("Password")?> <?php if ($error == "password") { ?><span class="form_error_reason"><?=Text::translate("Did Not Meet Requirements")?></span><?php } ?></label>
					<input type="password" class="required<?php if ($policy) { ?> has_tooltip" data-tooltip="<?=htmlspecialchars($policy_text)?><?php } ?>" name="password" value="" tabindex="3" />
					<?php if ($policy) { ?>
					<p class="password_policy"><?=Text::translate("Password Policy In Effect")?></p>
					<?php } ?>
				</fieldset>
				
				<fieldset>
					<label class="required"><?=Text::translate("User Level")?></label>
					<select name="level" tabindex="5">
						<option value="0"><?=Text::translate("Normal User")?></option>
						<option value="1"<?php if ($level == 1) { ?> selected="selected"<?php } ?>><?=Text::translate("Administrator")?></option>
						<?php if ($admin->Level > 1) { ?><option value="2"<?php if ($level == 2) { ?> selected="selected"<?php } ?>><?=Text::translate("Developer")?></option><?php } ?>
					</select>
				</fieldset>
			</div>
			<div class="right">
				<fieldset>
					<label><?=Text::translate("Name")?></label>
					<input type="text" name="name" value="<?=$name?>" tabindex="2" />
				</fieldset>
				
				<fieldset>
					<label><?=Text::translate("Company")?></label>
					<input type="text" name="company" value="<?=$company?>" tabindex="4" />
				</fieldset>
				
				<br />
				<fieldset>
					<input type="checkbox" name="daily_digest" <?php if ($daily_digest) { ?>checked="checked" <?php } ?>/>
					<label class="for_checkbox"><?=Text::translate("Daily Digest Email")?></label>
				</fieldset>
			</div>
		</section>
		<footer>
			<input type="submit" class="blue" value="<?=Text::translate("Create", true)?>" />
		</footer>
	</form>
</div>
<script>
	BigTreeFormValidator("form.module");
	BigTreePasswordInput("input[type=password]");
	
	$(document).ready(function() {
		$("input.email").blur(function() {
			$(this).parent("fieldset").find(".gravatar").show().find("img").attr("src", 'http://www.gravatar.com/avatar/' + md5($(this).val().trim()) + '?s=36&d=' + encodeURIComponent("<?=ADMIN_ROOT?>images/icon_default_gravatar.jpg") + '&rating=pg');
		});
	});
</script>