@php
    $configData = Helper::applClasses();
    $sidebar = DysidebarContentData();
    //  dd( Auth::user()->can(Auth::user()->staff_role_id . '.rolepermission.read'))
@endphp
{{-- <div
  class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow"
  data-scroll-to-active="true"> --}}
<div class="main-menu menu-fixed menu-light bg-sidebar menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                {{-- <a class="navbar-brand" href="{{ url('/admin') }}"> --}}
                <a class="navbar-brand mt-2" href="{{ route('admin.dashboard') }}">
                    <span class="brand-logo">
                        <img src="{{ site_logo() }}" alt="{{ setting('site_name') }}"
                            alt="{{ setting('site_name') }}" />
                    </span>
                    {{-- <h2 class="brand-text">{{ setting('site_name') }}</h2> --}}
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="mt-2 navigation navigation-main text-capitalize" id="main-menu-navigation"
            data-menu="menu-navigation">
            <?php
            if (!empty($sidebar)) {
                foreach ($sidebar as $value) {
                    if (empty($value)) {
                        continue;
                    }

                    if (isset($value['roles']) && !Auth::user()->hasRole($value['roles'])) {
                        continue;
                    }

                    $is_open = '';
                    if (!empty($value['childData'])) {
                        array_map(function ($childValue) use (&$is_open) {
                            $link_attribute = $childValue['link_attribute'] ?? [];
                            $is_open = $childValue['link_type'] != 'external_link' && url()->current() === route($childValue['link'], $link_attribute) ? 'open' : $is_open;
                        }, $value['childData']);
                    }
                    $link_attribute = isset($value['link_attribute']) ? $value['link_attribute'] : [];
                    $target = Route::has($value['link']) ? '_self' : (!empty($value['link']) ? '_target' : '_self');
                    echo '<li class="nav-item ' .
                        (!empty($value['childData']) ? 'has-sub' : '') .
                        ' ' .
                        (!empty($value['open']) ? 'opens' : '') .
                        ' ' .
                        $is_open .
                        ' ' .
                        (Route::has($value['link']) && url()->current() === Route($value['link'], $link_attribute) ? 'active' : '') .
                        '">
                                                                                                                                      <a href="' .
                        (Route::has($value['link']) ? route($value['link'], $link_attribute) : (!empty($value['link']) ? $value['link'] : 'javascript:void(0)')) .
                        '" class="d-flex align-items-center " target="' .
                        $target .
                        '">
                                                                                                                                          <i data-feather="' .
                        $value['icon'] .
                        '"></i>
                                                                                                                                          <span class="menu-title text-truncate">' .
                        $value['label'] .
                        '</span>
                                                                                                                                          <!-- <span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span> -->
                                                                                                                                      </a>';

                    if (!empty($value['childData'])) {
                        echo '<ul class="menu-content">';
                        foreach ($value['childData'] as $childValue) {
                            if (isset($childValue['roles']) && !Auth::user()->hasRole($childValue['roles'])) {
                                continue;
                            }

                            $link_attribute = isset($childValue['link_attribute']) ? $childValue['link_attribute'] : [];
                            echo '<li class="' .
                                ($childValue['link_type'] != 'external_link' && url()->current() === Route($childValue['link'], $link_attribute) ? 'active' : '') .
                                '">


                                                                                    <a href="' .
                                (Route::has($childValue['link']) ? route($childValue['link'], $link_attribute) : (!empty($childValue['link']) ? $childValue['link'] : 'javascript:void(0)')) .
                                '" class="d-flex align-items-center " target="' .
                                $target .
                                '">
                                                                                                                                                  <i data-feather="' .
                                $childValue['icon'] .
                                '"></i>
                                                                                                                                                  <span class="menu-item text-truncate">' .
                                $childValue['label'] .
                                '</span>
                                                                                                                                              </a>
                                                                                                                                          </li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            }
            ?>
        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 546px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 164px;"></div>
        </div>
    </div>
</div>
<!-- END: Main Menu-->
