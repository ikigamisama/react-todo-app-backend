$(document).ready(function(){
    
    var todoAjax = {};

    var localhost = 'http://todoapp.me';
    todoAjax.get = function(){
        //this.query('GET','http://todoapp.me/dashboard/fetchdata');
    };
    todoAjax.updateTodoListCheck = function(id,isChecked){
        var dataTosubmit = {
            'id':id,
            'isChecked':isChecked
        }
        
        $.ajax({
            url:localhost+'/dashboard/edit_todo_done/'+dataTosubmit.id +'/'+dataTosubmit.isChecked,
            success:function(data){
                todoAjax.getAllCountTodo();
            }
        })
    };
    todoAjax.getAllCountTodo = function(){
        $.ajax({
            url:localhost+'/dashboard/count',
            success:function(data){
                data = JSON.parse(data);
                $('#todo_count_this_day').html(data.all_todo_this_date);
                $('#todo_checked').html(data.all_todo_check);
                $('#todo_all_post').html(data.all_todo_post);
            }
        })
    }
    $('.check-done').change(function(){
        var data_id = $(this).data('id');
        if(!this.checked){
            todoAjax.updateTodoListCheck(data_id,false)
        }
        else{
            todoAjax.updateTodoListCheck(data_id,true)
        }
        
    })
    todoAjax.getAllCountTodo();

})