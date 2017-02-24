<div class="wrap">
    <form method="post" name="test_centre" enctype="multipart/form-data" id="terms_condition" >
    <input type="hidden" name="action" value="Process">
    <p>Do NOT use your browser back and forward buttons - use the Next and Previous buttons on the forms </p>
    
    <p><b>NOTE: The terms below must be met prior to you qualifying for unlimited re-tests</b></p>
    <table border="1">
        <tr>
            <td>Question</td>
            <td>Answer </td>
        </tr>
        <tr>
            <td>What do you get? </td>
            <td>
                <p>PASS Protection Plus, which could provide you with re-tests until you pass if you fail your test.</p>

                <p>We provide re-tests if you fail the multiple choice questions part of the test, or if you fail the hazard perception part of the test, after meeting these terms. </p>
            </td>
        </tr>
        <tr>
            <td>What do you need to do? </td>
            <td>
                <p>Use your online theory training account at www.DrivingTheory4All.co.uk supplied as part of this booking and score at least 90% in all of our topic tests and pass at least 10 mock tests.</p>

                <p>If you then fail your test after meeting the above terms and after scoring at least 35 out of 50 in the multiple choice questions part of the test and after scoring at least 40 out of 75 in the hazard perception part of the test, just send your original failure document to us for processing. </p>
            </td>
        </tr>
        <tr>
            <td>What do we do?  </td>
            <td>
                <p>We will verify your use of our site to ensure you have met the above criteria, and we will check your failure document to verify your actual scores.</p>

                <p>If everything is OK we will then provide you with re-tests until you pass. Re-tests will be booked for you at times to suit you and we will also extend your access to our online theory training site to allow you to keep practicing the questions and hazard perception videos.</p>
            </td>
        </tr>
        <tr>
            <td>Do you need this?</td>
            <td>
                <p>Approximately 400,000 car theory tests are failed each year - that's about 40% of all tests taken. If you don't pass and you meet the above criteria PASS Protection Plus could save you the cost of re-tests.</p>
            </td>
        </tr>
    </table>
    <p>Important: If you fail to take your test for any reason (for example you do not turn up for the test or you do not take the required documentation to the test centre) you will not be able to make a valid PASS Protection Plus claim - you must be able to produce your test failure certificate. </p>
    <p><input type="checkbox" value="yes" name="terms" <?php echo ($this->session->userdata('TERMS') == 'yes')?'checked':''; ?>>I have read and understood the above terms for getting unlimited re-tests</p>
    <div><a href="<?php echo base_url().'pass_guarantee/fourth';?>">Previous</a><button class="btn-login" type="submit">Next</button></div>
    </form>
</div>