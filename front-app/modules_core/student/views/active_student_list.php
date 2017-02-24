<section>
  <div class="container">          
    <article>
	<div class="dil-box student-list">                
	  <article>
	    <h3 class="heading-txt">Students List</h3>
	    <div class="table-responsive">
	      <table>
		<thead>
		  <tr>
		    <th>Name</th>
		    <th>Email</th>
		    <th>Phone</th>
		    <th>last login</th>
		  </tr>
		</thead>
		<tbody>
		<?php foreach($student_all as $student) { ?>
		  <tr>
		    <td data-title="Name"><a href="<?php echo base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/report/'.$student['student_id'];?>"><?php echo stripslashes($student['student_fname']).' '.stripslashes($student['student_lname']);?></a></td>
		    <td data-title="Email"><?php echo $student['student_email'];?></td>
		    <td data-title="Phone"><?php echo ($student['student_phone'] != '')?$student['student_phone']:'N/A';?></td>
		    <td data-title="last login"><?php echo ($student['last_login'] != '0000-00-00 00:00:00')?date('d/m/Y',strtotime($student['last_login'])):'';?></td>
		  </tr>
		<?php } ?>
		<?php if(!empty($paging)){ ?>
		<tr>
		    <td>
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
