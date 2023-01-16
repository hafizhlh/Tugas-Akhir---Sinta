<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
		<span class="menu-icon">
			<i class="{{$parent_icon}}"></i>
		</span>
        <span class="menu-text"> {{$parent}} </span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            @foreach($menus as $item)
                @if(count($item['menu_childs'])!=0)
                    @include('templates.menucomponent',['menus' => $item['menu_childs'],'parent'=>$item['name'],'parent_icon' => $item['icon']])
                @else
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{$item['url']}}" class="menu-link">
							<span class="menu-icon">
								<i class="{{$item['icon']}}"></i>
							</span>
                            <span class="menu-text"> {{$item['name']}} </span>
                            {{-- <span class="menu-label"> --}}
                            {{-- <span class="label label-rounded label-primary">6</span> --}}
                            {{-- </span> --}}
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</li>