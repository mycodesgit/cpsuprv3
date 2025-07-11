@extends('layouts.master')

@section('body')
    <section class="section">
        <div class=""
            style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Dashboard</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-welcome d-lg-flex justify-content-between align-items-center py-6 py-lg-3 px-8 text-center text-lg-start rounded">
                                <div class="d-lg-flex align-items-center">
                                    <img src="{{ asset('template/assets/img/products/icons8-basket-96.png') }}" alt="" class="img-fluid" style="" width="100" />
                                    <div class="">
                                        <h1 class="" style="text-align: left;">Welcome to CPSU Purchase Request</h1>
                                        <span style="text-align: left; font-family: Bookman Old Style;">
                                            Streamline your purchasing process with this <span class="text-primary">Platform</span>. Submit your requests effortlessly and <b>ensure a smooth experience.</b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Updates</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-1.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Now</div>
                                        <div class="media-title">Farhan A Mujib</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-2.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right">12m</div>
                                        <div class="media-title">Michelle Green</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-3.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right">17m</div>
                                        <div class="media-title">Debra Stewart</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-4.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right">21m</div>
                                        <div class="media-title">Alfa Zulkarnain</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="text-center pt-1 pb-1">
                                <a href="#" class="btn btn-primary btn-lg btn-round">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-md-4 col-lg-4">
                    <article class="article article-style-c">
                        <div class="article-details">
                            <div class="article-category">
                                <span>
                                    <h3>
                                        <img src="{{ asset('template/assets/img/icons/system-solid-46-notification-bell-hover-bell.gif') }}" style="width: 10%">Announcement
                                    </h3>
                                </span>
                            </div>
                            <div class="article-title">
                                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                            </div>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="article-user">
                                <img alt="image" src="{{ asset('template/assets/img/avatar/avatar-1.png') }}">
                                <div class="article-user-details">
                                    <div class="user-detail-name"><a href="#">Susie Willis</a></div>
                                    <div class="text-job">Web Developer</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
