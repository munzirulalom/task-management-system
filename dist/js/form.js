var root = document.location.origin+"/cse200";
projectList = document.querySelector(".task-project-list");
notificationList = document.querySelector(".notification-list");
incoming_id = null;

$(document).ready(function () {
  addProject();
});

//Load DOM on page load
$(document).ready(function() {
  getProjectList();
  getNotification();
});


/**
* 
* Add New Project to Database
* 
*/
function addProject(){
  $("#add-project").submit(function (event) {
    var formData = {
      project_name: $("#project-name").val(),
      project_type: $('input[name="project-type"]:checked').val(),
    };

    $.ajax({
      type: "POST",
      url: root + "/ajax/add-project.php",
      data: formData,
      // dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
      $("#add-project").trigger("reset");
      getProjectList();

    });

    event.preventDefault();
  });
}

//Get Project List
function getProjectList(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/get-project.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;
        projectList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id="+incoming_id);
}

function deleteProject( project_id ){
  if (confirm("Are you sure? You want to delete this project? It also delete all the related tasks and subtasks.")) {
    
    //Send AJAX Request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", root + "/ajax/delete-project.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          console.log("Delete Project: " + project_id);
          location.reload(true);
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("project_id=" + project_id + "&status=" + true);
  } else {
    console.log("Cancel!");
  }
}

//Get Project List
function getNotification(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", root + "/ajax/get-notification.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;
        notificationList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send();
}

/**
 * 
 * Auto Server Request
 * 
 */

setInterval(getProjectList, 60000);
setInterval(getNotification, 15000);