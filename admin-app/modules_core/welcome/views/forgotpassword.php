<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!-- center-pannel -->
    <div class="center_seg2">
        <h1><span class="blue_txt">Forgot </span> Password</h1>
        <p class="header_line"></p><br />
        <form name="frm_forgotpassword" id="frm_forgotpassword" action="<?php echo base_url(); ?>user/do_forgotpassword/" method="post"  onsubmit="return $('#frm_forgotpassword').validationEngine({returnIsValid:true});">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.</p><br />
            <div class="from-div">User Email <br /> <input name="email" id="email" type="text" class="validate[required,custom[email]] input-80" /></div>
            <div class="from-div">
            <input type="submit" class="send-btn" value="Submit">&nbsp;<button type="button" class="btn100" onclick="javascript:window.location='<?php echo base_url(); ?>user/';">Cancel</button>
            </div>
        </form>
    </div>
