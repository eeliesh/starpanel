<h3 class="heading">
    <span class="material-icons">dashboard</span>
    Overview
</h3>
<ul class="list-reset overview">
    <li>
        <div class="title">
            <span class="material-icons">badge</span>
            <span>Username</span>
        </div>
        <div class="value">{{ $user->name }}</div>
    </li>
    <li>
        <div class="title">
            <span class="material-icons">email</span>
            <span>Email</span>
        </div>
        <div class="value">{{ $user->email }}</div>
    </li>
    <li>
        <div class="title">
            <span class="material-icons">key</span>
            <span>Password</span>
        </div>
        <div class="value">******</div>
    </li>
</ul>