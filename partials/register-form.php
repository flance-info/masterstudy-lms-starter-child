<?php
?>

<div class="stm-register-form-wrap">
    <form id="stm-register-form" novalidate="novalidate">
        <h4 class="stm-register-form--title"><?php _e('Register form', 'lms-starter-theme'); ?></h4>
        <div class="form-group">
            <input id="first_name" name="first_name" type="text" placeholder="First name" class="valid">
            <input id="email" name="email" type="text" placeholder="Email" class="valid">
            <input id="last_name" name="last_name" type="text" placeholder="Last name" class="valid">
            <input id="phone" name="phone" type="text" placeholder="Phone" class="valid">
        </div>
        <div class="form-group button-wrap">
            <button type="submit" class="button">Send</button>
        </div>
    </form>
</div>
