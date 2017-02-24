<div class="wrap innerAdmin">
<div class="selectProduct">
 <form action="<?php echo FRONTEND_URL.'learn'; ?>" method="post" name='course' id='course' onsubmit="return validateForm()">
 <input type="hidden" name="action" value="Process">
    <h3>Select Product you like to work with : </h3>
	<ul>
<?php
if(isset($fetch_course))
{
  foreach($fetch_course as $course)
  {
    ?>
      <li>
	<input type="radio" name="course" class="course" id="course_<?php echo $course['id'];?>" value="<?php echo $course['id'];?>"><?php echo $course['name'];?>
      </li>
    <?php
  }
}
?>
      <li><input type="submit" name="submit" value="Go"></li>
    </ul>
  </form>
</div>
</div>
<script type="text/javascript">
function validateForm() {
    if($('input[name=course]:checked').length<=0)
    {
      alert("Please select atleast one course");
      return false;
    }
}
</script>