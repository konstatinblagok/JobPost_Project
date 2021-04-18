<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('job_posting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.job-postings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/job-postings") || request()->is("admin/job-postings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.jobPosting.title') }}
                </a>
            </li>
        @endcan
        @can('post_location_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.post-locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/post-locations") || request()->is("admin/post-locations/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-globe-americas c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.postLocation.title') }}
                </a>
            </li>
        @endcan
        @can('credential_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.credentials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/credentials") || request()->is("admin/credentials/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-key c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.credential.title') }}
                </a>
            </li>
        @endcan
        @can('driver_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.drivers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/drivers") || request()->is("admin/drivers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.driver.title') }}
                </a>
            </li>
        @endcan
        @can('post_history_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.post-histories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/post-histories") || request()->is("admin/post-histories/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.postHistory.title') }}
                </a>
            </li>
        @endcan
        @can('click_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.clicks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clicks") || request()->is("admin/clicks/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-mouse-pointer c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.click.title') }}
                </a>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/teams*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                    </i>
                    <span>{{ trans("global.team-members") }}</span>
                </a>
            </li>
        @endif
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>