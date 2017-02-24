<section>
  <div class="container">          
    <article>
	<div class="dil-box student-list">                
	  <article>
	    <h3 class="heading-txt">Students List</h3>
	    <div class="table-responsive">
	      <table>
		<thead>
		    <?php if($totalRecord < $student_no->no_student){ ?>
		    <tr>
			<td  colspan="5" class="add_user">
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
		    <td colspan="6" align="center"> -- Sorry no record found!--</td>
		<tbody>
		</tbody>
	      </table>                    
	    </div>
	  </article>
	</div>
    </article>
  </div>        
</section>
