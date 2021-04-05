//popup
function openPopUp(obj){
	id = obj.id;
	document.querySelector('div[id="popup_'+id+'"][class="overlay"]').style.visibility = 'visible';
}

function closePopUp(){
	var close = document.querySelectorAll('.overlay');
	for(var i = 0;i<close.length;i++){
		close[i].style.visibility = 'hidden';
	}
}

//menu
function collapse(obj){
	console.log('OK Je passe par ici');
	collapsible = obj;
    collapsible.classList.toggle("active");
    var content = collapsible.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
}

//import csv 

function importCSV() {
    $("#frmCSVImport").on("submit", function () {

      $("#response").attr("class", "");
      $("#response").html("");
      var fileType = ".csv";
      var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
      if (!regex.test($("#customFile").val().toLowerCase())) {
          $("#response").addClass("error");
          $("#response").addClass("display-block");
        $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
        return false;
      }
      return true;
    });
}

//Login

let tabs = document.querySelectorAll(".tab-link:not(.desactive)");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    unSelectAll();
    tab.classList.add("active");
    let ref = tab.getAttribute("data-ref");
    document.querySelector(`.tab-body[data-id="${ref}"]`).classList.add("active");
  });
});

function unSelectAll() {
  tabs.forEach((tab) => {
    tab.classList.remove("active");
  });
  let tabbodies = document.querySelectorAll(".tab-body");
  tabbodies.forEach((tab) => {
    tab.classList.remove("active");
  });
}

document.querySelector(".tab-link.active").click();
