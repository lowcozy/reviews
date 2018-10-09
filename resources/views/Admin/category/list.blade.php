@extends('Admin.layouts.app')
@section('title', 'Danh sách tài khoản')
@section('header')
@include('Admin.includes.header', ['function' => 'Danh sách Tài Khoản'])
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>

        <div class="card-content">
            <h4 class="card-title">Simple Table</h4>
            <div class="row">
            <div class="col-md-4">
                <select
                id = "limit"
                 class="selectpicker" data-style="select-with-transition" title="Numbers result" data-size="7">
                    
                    <option value="1" selected="">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="0">All</option>
                   
                </select>
            </div>

            <div class="col-md-4">
                <select
                id = "selectRole"
                 class="selectpicker" data-style="select-with-transition" title="Choose Role" data-size="7">
                    <option value="All" selected="">All Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Collab">Collab</option>
                    <option value="Member">Member</option>
                </select>
            </div>
        </div>

            <div id="result" class="table-responsive">
                Data goes here.
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script language="javascript">
    function sortTable(col) {
        $("#col-sort").val(col);
        if(sort=="asc") {
            $("#sort").val("desc");
        }
        else $("#sort").val("asc");
        loadCat();
    }

    function getKeyWord() {
        var keyword = $("#keyword").val();
        return keyword;
    }

    function getLimit() {
        var limit = $("#limit").val();
        return limit;
    }

    function getPage(){
        var x = location.hash;
        var numb = x.match(/\d/g);
        if(numb!=null) {
            numb = numb.join("");
        } else numb = 1;
        return numb;
    }

    function getCat(){
        let url = location.href;
        var res = url.slice(-2);
        var numb = res.match(/\d/g);
        //console.log(numb);
        numb = (numb) ? numb.join("") : "x";
        console.log(numb);
        let searchParams = new URLSearchParams(window.location.search);
        var param = null;
        if(searchParams.has('id')) {
            param = searchParams.get('id');
        }

        if(param=="-1") param="un";

        return (isNaN(numb)) ? param : numb;
        
    }
    function getKeyWordUrl() {
        let searchParams = new URLSearchParams(window.location.search);
        var param = null;
        if(searchParams.has('keyword')) {
            param = searchParams.get('keyword');
        }
        return param;
    }
    function loadCat(page=null){
        //sort = $('#sort').val();
        //col = $('#col-sort').val();
        //alert(page);
        let limit = getLimit();
        if(!page) page = getPage();

        keyword = getKeyWord();
        load_ajax(page, limit, keyword);
        location.hash = page;
    }
    function load_ajax(page, limit=5, keyword = null, column = null, sort=null){
        $.ajax({
            url : '{{ route('admin.category.table') }}',
            type : "get",
            dataType:"text",
            data : {
                '_token' : "{{ csrf_token() }}",
                page : page,
                limit : limit,
                keyword : keyword,
                column : column,
                sort : sort
            },
            success : function (result){
                //alert(result)
                $('#result').html(result);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
    
    $(document).ready(function(){
        $(document).on('click', '.pagination a', function (e) {
            loadCat($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
        if(getKeyWordUrl()) {
            let keyword = getKeyWordUrl();
            $(`#keyword`).val(keyword);
        }
        loadCat();
        $("#limit").change(function(){
            //window.location.hash = 1;
            loadCat();
        });
        $("#keyword").keyup(function(){
            loadCat();
        });
        
    });
    $(window).on('hashchange', function(){
        loadCat();
    }).trigger('hashchange');

    </script>
@endsection
