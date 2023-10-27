<style>
    .btn{
    margin-right: 8px;
    font-size: 12px;
    position: relative;
    transition: all .15s ease;
    letter-spacing: -.025em;
    color: #fff;
    text-transform: uppercase;
    background-image: linear-gradient(310deg,#7928ca,#ff0080);
    box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);
    font-weight: 700;
    line-height: 1.5;
    padding: 10px 20px !important;
    cursor: pointer;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-align: center;
    vertical-align: middle;
    border-radius: 12px;
    text-decoration: none;
    margin: 10px !important;
    }
    p{
        margin-top: 10px !important;
    }
</style>
<h4>Xin chào {{$user->name}}</h4>

<p>Nhấn vào để thay đổi mật khẩu</p>

<a class="btn btn-primary text-2xl" href="{{url('reset/'.$user->remember_token)}}">
Thay đổi mật khẩu
</a>

<p>Trong trường hợp có vấn đề gì xảy ra vui lòng liên hệ với chúng tôi.</p><br>
{{ config('app.name') }}
