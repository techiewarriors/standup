

function addYesterDayTaskList() {
        let li = document.createElement("li");
        let inputValue = document.getElementById("add_yesterday_task").value;

        // Ajax to check if this issue exists in jira or not
        var formData = {
            new_issue: inputValue
        }
        jQuery.ajax({
            type: "POST",
            url: "../assets/includes/ajax.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        .done(function (data) {
            //console.log(data);
        });
        
        let t = document.createTextNode(inputValue);
        li.appendChild(t);

        if (inputValue === '') {
        alert("You must write something!");
        } else {
        document.getElementById("yesterday_task_list").appendChild(li);
        }
        document.getElementById("add_yesterday_task").value = "";
    

        let parentSpan = document.createElement("span");
        parentSpan.className = "extraEventsItem input-group-addon";


    
        /* Extra data */
        let moveSpan = document.createElement("span");
        let moveTxt = document.createTextNode("move");
        moveSpan.className = "moveItem fa fa-bars";
        //moveSpan.appendChild(moveTxt);
        parentSpan.appendChild(moveSpan);


        let closeSpan = document.createElement("span");
        let closeTxt = document.createTextNode("close");
        closeSpan.className = "removeItem fa fa-times";
       // closeSpan.appendChild(closeTxt);
        parentSpan.appendChild(closeSpan);
    

        li.appendChild(parentSpan)


        for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
            }
        }
}


var addYesterdayTask = document.getElementById('add_yesterday_task');
addYesterdayTask.onkeydown = function(e) {
    if (e.key == "Enter") {
        addYesterDayTaskList();
        e.preventDefault();
    }
};


    /* On input foucs add class to parent div */

    

    const onFousAddClassToParentDiv = function (el) {
        el.addEventListener('focus', function(){
            el.parentNode.classList.add("active");
        });

        el.addEventListener('focusout', function(){
            el.parentNode.classList.remove("active");
        });
    }

    document.querySelectorAll('.wdm-question-input .form-control').forEach(function(el){
        onFousAddClassToParentDiv(el); 
    })



    /* addPlanningTaskList */


    function addPlanningTaskList(){

        let li = document.createElement("li");
        let inputValue = document.getElementById("add_today_planning").value;
        let t = document.createTextNode(inputValue);
        li.appendChild(t);
        if (inputValue === '') {
        alert("You must write something!");
        } else {
        document.getElementById("planning_task_list").appendChild(li);
        }
        document.getElementById("add_today_planning").value = "";
    

        let parentSpan = document.createElement("span");
        parentSpan.className = "extraEventsItem input-group-addon";


    
        /* Extra data */
        let moveSpan = document.createElement("span");
        let moveTxt = document.createTextNode("move");
        moveSpan.className = "moveItem fa fa-bars";
        //moveSpan.appendChild(moveTxt);
        parentSpan.appendChild(moveSpan);


        let closeSpan = document.createElement("span");
        let closeTxt = document.createTextNode("close");
        closeSpan.className = "removeItem fa fa-times";
       // closeSpan.appendChild(closeTxt);
        parentSpan.appendChild(closeSpan);
    

        li.appendChild(parentSpan)


        for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
            }
        }

    }

    var addTodayTask = document.getElementById('add_today_planning');
    addTodayTask.onkeydown = function(e) {
        if (e.key == "Enter") {
            addPlanningTaskList();
            e.preventDefault();
        }
    };


    /* Chaallenges */

      /* addPlanningTaskList */


    function addChallengesList(){

        let li = document.createElement("li");
        let inputValue = document.getElementById("add_challenges").value;
        let t = document.createTextNode(inputValue);
        li.appendChild(t);
        if (inputValue === '') {
        alert("You must write something!");
        } else {
        document.getElementById("challenges_task_list").appendChild(li);
        }
        document.getElementById("add_challenges").value = "";
    

        let parentSpan = document.createElement("span");
        parentSpan.className = "extraEventsItem input-group-addon";


    
        /* Extra data */
        let moveSpan = document.createElement("span");
        let moveTxt = document.createTextNode("move");
        moveSpan.className = "moveItem fa fa-bars";
        //moveSpan.appendChild(moveTxt);
        parentSpan.appendChild(moveSpan);


        let closeSpan = document.createElement("span");
        let closeTxt = document.createTextNode("close");
        closeSpan.className = "removeItem fa fa-times";
       // closeSpan.appendChild(closeTxt);
        parentSpan.appendChild(closeSpan);
    

        li.appendChild(parentSpan)


        for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
            }
        }

    }

    var addTodayTask = document.getElementById('add_challenges');
    addTodayTask.onkeydown = function(e) {
        if (e.key == "Enter") {
            addChallengesList();
            e.preventDefault();
        }
    };


    /* Form Submission */


    jQuery(document).ready(function () {
        jQuery("form").submit(function (event) {
          var formData = {
            name: jQuery("#name").val(),
            email: jQuery("#email").val(),
            superheroAlias: jQuery("#superheroAlias").val(),
          };
      
          jQuery.ajax({
            type: "POST",
            url: "process.php",
            data: formData,
            dataType: "json",
            encode: true,
          }).done(function (data) {
            console.log(data);
          });
      
          event.preventDefault();
        });

        jQuery("#add_yesterday_task").keyup(function() {
            var task = jQuery('#add_yesterday_task').val();
            var data_list = jQuery("#issues");
            if(task.length == 4) {
                var formData = {
                    search_key: task
                }
                jQuery.ajax({
                    type: "POST",
                    url: "../assets/includes/ajax.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                })
                .done(function (data) {
                    var data_list = '';
                    jQuery.each(data, function(index) {
                        data_list += '<option value="'+data[index]+'">';
                    });
                    jQuery(document).find("#issues").html(data_list);
                });
            }
        });
      });
      


     //jQuery( "#task_submission_form" ).on( "submit", function(e) {
      
      $(document).on('click', '.pushblish_standup', function(e){
 
        e.preventDefault();
        
        var question_yesterday = new Array();
        $('ul#yesterday_task_list li').each(function(){
            question_yesterday.push($(this).text());
        });

        var question_today = new Array();
        $('ul#planning_task_list li').each(function(){
            question_today.push($(this).text());
        });

        var question_challenges = new Array();
        $('ul#challenges_task_list li').each(function(){
            question_challenges.push($(this).text());
        });

          $.ajax({
            type: "POST",
            url: "process.php",
            data: "question_yesterday="+question_yesterday+"&question_today="+question_today+"&question_challenges="+question_challenges,
            success: function(data){

                console.log('success     = ', data);
                var obj = $.parseJSON(data);
                var msg = '';

                if(obj.status == true) {
                    msg = '<div class="alert alert-success" role="alert">'+obj.msg+'</div>';
                } else {
                    msg = '<div class="alert alert-danger" role="alert">'+obj.msg+'</div>';
                }

                $('#msg_div').html(msg);
                $('html,body').animate({scrollTop: $("#msg_div").offset().top}, 'slow');

                setTimeout(function(){ window.location.reload(); }, 3000);

           },
           error: function(data){

                alert('error');
                console.log('error = ', data);
                return false;
           }
        });

        
    });
 
