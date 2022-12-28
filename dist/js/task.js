var root = document.location.origin+"/cse200";
taskList = document.querySelector(".task-list");
subtaskList = document.querySelector(".sub-task-list");
assignedList = document.querySelector(".assigned-user-list");
cat_id = $('input[name="cat"]').val();
incoming_id = null;
ref = window.location.href;

$(document).ready(function () {
  addTask();
  searchUser();
  addSubtask();
});

//Load DOM on page load
$(document).ready(function() {
  getTaskList();
  getAssignedUserList();
});


/**
* 
* Add New Task List to Database
* 
*/
function addTask(){
  $("#add-task").submit(function (event) {
    var formData = {
      cat_id: cat_id,
      task_name: $('input[name="task_name"]').val(),
      assigned_to: $('input[name="assigned_to"]').val(),
      task_priority: $('select[name="task_priority"]').val(),
      remainder_date: $('input[name="remainder_date"]').val(),
      due_date: $('input[name="due_date"]').val(),
      note: $('textarea[name="note"]').val(),
      action: "add",
    };

    $.ajax({
      type: "POST",
      url: root + "/ajax/add-task.php",
      data: formData,
      encode: true,
    }).done(function (data) {
      console.log(data);
      $("#add-task").trigger("reset");
      getTaskList();
    });

    event.preventDefault();
  });
}

//Update Task Informations
/*function updateTask(){
  $("#update-task").submit(function (event) {
    var formData = {
      cat_id: cat_id,
      task_id: $('input[name="update_task_id"]').val(),
      task_name: $('input[name="update_task_name"]').val(),
      assigned_to: $('input[name="update_assigned_to"]').val(),
      task_priority: $('select[name="update_task_priority"]').val(),
      remainder_date: $('input[name="update_remainder_date"]').val(),
      due_date: $('input[name="update_due_date"]').val(),
      note: $('textarea[name="update_note"]').val(),
      action: "update",
    };

    $.ajax({
      type: "POST",
      url: root + "/ajax/add-task.php",
      data: formData,
      //encode: true,
    }).done(function (data) {
      console.log(data);
      $("#update-task").trigger("reset");
      //getTaskList();
    });
  });
}*/

//Delete Task and all sub task from database
function deleteTask( task_id ){
  if (confirm("Are you sure? You want to delete this task.")) {
    
    //Send AJAX Request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", root + "/ajax/delete-task.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          console.log("Delete " + task_id);
          getTaskList();
          getSubtaskList( task_id );
          $("#update-task").trigger("reset");
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("task_id=" + task_id + "&status=" + true);
  } else {
    console.log("Cancel!");
  }
}

//Get Task List
function getTaskList(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/get-tasks.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;
        taskList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("category_id="+cat_id);
}

/**
* 
* Add New Subtask List to Database
* 
*/
function addSubtask(){
  $("#add-sub-task").submit(function (event) {
    var formData = {
      task_id: $('input[name="task_id"]').val(),
      subtask_title: $('input[name="sub_task_name"]').val(),
    };

    $.ajax({
      type: "POST",
      url: root + "/ajax/add-subtask.php",
      data: formData,
      encode: true,
    }).done(function (data) {
      $("#add-sub-task").trigger("reset");
      getSubtaskList( formData['task_id'] );

    });
    event.preventDefault();
  });
}

//Get Sub Task List
function getSubtaskList( task_id ){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/get-sub-tasks.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;

        document.getElementById("task_id").value = task_id;
        window.history.replaceState(null, null, "?task_id=" + task_id);
        subtaskList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("task_id=" + task_id + "&category_id=" + cat_id);
}

/**
 * 
 * Task Checkbox
 * 
 * Change task stataus to the database
 * 
 */
function checkTask( task_id ){
  var checkBox = document.getElementById( task_id );

  if (checkBox.checked == true){
    console.log("Checked " + task_id);

    //Send AJAX Request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", root + "/ajax/update-task-status.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          getTaskList();
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("task_id=" + task_id + "&status=" + true);

  } else {
   console.log("Un-Checked " + task_id);

     //Send AJAX Request
     let xhr = new XMLHttpRequest();
     xhr.open("POST", root + "/ajax/update-task-status.php", true);
     xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          getTaskList();
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("task_id=" + task_id + "&status=" + false);
  }
}

function checkSubTask( subtask_id, task_id ){
  var checkBox = document.getElementById( "subtask"+subtask_id );

  if (checkBox.checked == true){
    console.log("Checked " + subtask_id);

    //Send AJAX Request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", root + "/ajax/update-subtask-status.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          getSubtaskList( task_id );
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("subtask_id=" + subtask_id + "&status=" + true);

  } else {
   console.log("Un-Checked " + subtask_id);

     //Send AJAX Request
     let xhr = new XMLHttpRequest();
     xhr.open("POST", root + "/ajax/update-subtask-status.php", true);
     xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          getSubtaskList( task_id );
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("subtask_id=" + subtask_id + "&status=" + false);
  }
}

/**
 * 
 * User Search From Databse
 * 
 */
function searchUser(){
  $("#user_search").on("keyup", function () {
    var search_term = $(this).val();

    $.ajax({
      url: root + "/ajax/user-search.php",
      type: "POST",
      data: {search:search_term},
      success:function(data){
        $(".user-search-list").html(data);
      }
    });
  });
}

//Assigend user
function assignedUser( user_id ){
  var checkBoxUser = document.getElementById( user_id );

  //Send AJAX Request
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/assigned-user.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        console.log("Checked " + user_id);
        getAssignedUserList();
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("user_id=" + user_id + "&category_id=" + cat_id + "&status=" + true);
}

//De Assigend user
function deassignedUser( user_id ){
  var checkBoxUser = document.getElementById( user_id );

  //Send AJAX Request
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/assigned-user.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        console.log("UnChecked " + user_id);
        getAssignedUserList();
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("user_id=" + user_id + "&category_id=" + cat_id + "&status=" + false);
}

//Get Assigned User List
function getAssignedUserList(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/get-assigned-user.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;
        assignedList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("category_id="+cat_id);
}


$(document).ready(function (e) {
  $("#add-file").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
      url:  root + "/ajax/file-upload.php",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        console.log(data);
      },
      error: function(e) 
      {
        console.log(e);
      }
    });
  }));
});



/**
 * 
 * Auto Server Request
 * 
 */
setInterval(getTaskList, 5000);