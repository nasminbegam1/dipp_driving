<section>
  <div class="container">          
    <article>
	<div class="dil-box student-list">                
	  <article>
	    <h3 class="heading-txt">Students List</h3>
	    <?php
		$getMessage=flash_message();
		if(is_array($getMessage) && count($getMessage) > 0)
		{
		    $message_type=$getMessage['type'];
		    echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
		}
	    ?>
	    <div class="table-responsive">
	      <table>
		<thead>
		    <?php if($totalRecord < $student_no->no_student){ ?>
		    <tr>
			<td colspan="5" class="add_user">
			    <a href="<?php echo FRONTEND_URL.$this->session->userdata('INSTRUCTOR_BUSINESS_NAME');?>/add/">Create New Users</a>
			</td>
		    </tr>
		    <?php } ?>
		  <tr>
		    <th>Name</th>
		    <th>Email</th>
		    <th>Phone</th>
		    <th>last login</th>
		    <th>Actions</th>
		  </tr>
		</thead>
		<tbody>
		<?php foreach($student_all as $student) { ?>
		  <tr>
		    <td data-title="Name"><a href="<?php echo base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/report/'.$student['student_id'];?>"><?php echo stripslashes($student['student_fname']).' '.stripslashes($student['student_lname']);?></a></td>
		    <td data-title="Email"><?php echo $student['student_email'];?></td>
		    <td data-title="Phone"><?php echo ($student['student_phone'] != '')?$student['student_phone']:'N/A';?></td>
		    <td data-title="last login"><?php echo ($student['last_login'] != '0000-00-00 00:00:00')?date('d/m/Y',strtotime($student['last_login'])):'';?></td>
		    <td data-title="Actions">
			<a href="<?php echo $student['edit_link'];?>" title="Edit Active Users" class="editActiveUser">Edit Active Users</a>
			<a href="<?php echo $student['cancel_link'];?>" title="Cancel User Access" class="cancelUser">Cancel User Access</a>
			<!--<a href="<?php //echo $student['delete_link'];?>" title="Delete" onclick="return confirm('Are you sure to delete this student?');">Delete</a>-->
		    </td>
		  </tr>
		<?php } ?>
		<?php if(!empty($paging)){ ?>
		<tr>
		    <td colspan="5" class="pagination">
		    <div class="pagination"><?php echo $paging;?></div>
		    </td>
		</tr>
		<?php } ?>
		</tbody>
	      </table>                    
	    </div>
	  </article>
	</div>
    </article>
  </div>        
</section>
