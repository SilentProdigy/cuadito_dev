@extends('layouts.client-layout')

@section('style')
    <style>
        .read {
            background-color: #ecf0f1;
        }

        a {
            text-decoration: none;
            color: black;
        }

        button {
            background-color: #00C0EF;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 16px;
        }
    </style>
@endsection

@section('content')
    <div class="container px-5" style="background-color: white">
        {{-- <div class="row inbox">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body inbox-menu">
                        <button class="btn btn-danger btn-block" data-bs-toggle="modal"
                            data-bs-target="#create-new-conversation-modal">New Email</button>
                        @include('client.inbox.includes.rooms_links')
                        @include('client.inbox.includes.labels_links')
                    </div>
                </div>
                @include('client.inbox.includes.contact_list')
            </div>
            <!--/.col-->

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- @include('client.inbox.includes.email_actions') -->
                        @yield('main_room_section')
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div> --}}

        <h1>Messaging</h1>
        <div class="row inbox panel">

            <div class="col-lg-5 col-md-5 border p-2">
                <div class="border-bottom">
                    @include('client.inbox.includes.rooms_links')
                </div>

                <div class="row p-4">
                    <div class="col-lg-12 mt-5 mb-2">
                        <div class="card mb-3" style="max-width: 540px; background-color: #4CD3F4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="data:image/jpeg;base64,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"
                                        class="img-fluid p-3 mt-3" style="border-radius: 50%" />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">David</h5>
                                            </div>
                                            <div class="ml-auto">
                                                <h5>9:00 AM</h5>
                                            </div>
                                        </div>

                                        <p class="card-text d-flex justify-content-end mt-2">
                                            SUBJECT
                                        </p>
                                        <p class="card-text d-flex justify-content-end">
                                            <small>Lorem ipsum dolor sit amet ...</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-2">
                        <div class="card mb-3" style="max-width: 540px; background-color: #C7F1FC">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGUj4gZvxdut1nm6Hqq4A21umNSAEFgisZuLUcKFawtpC-IBMdweY9odF64nvuNG1ZnlI&usqp=CAU"
                                        class="img-fluid p-3 mt-3" style="border-radius: 50%" />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Melissa</h5>
                                            </div>
                                            <div class="ml-auto">
                                                <h5>8:58 AM</h5>
                                            </div>
                                        </div>

                                        <p class="card-text d-flex justify-content-end mt-2">
                                            SUBJECT
                                        </p>
                                        <p class="card-text d-flex justify-content-end">
                                            <small>Lorem ipsum dolor sit amet ...</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-2">
                        <div class="card mb-3" style="max-width: 540px; background-color: #C7F1FC">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGUj4gZvxdut1nm6Hqq4A21umNSAEFgisZuLUcKFawtpC-IBMdweY9odF64nvuNG1ZnlI&usqp=CAU"
                                        class="img-fluid p-3 mt-3" style="border-radius: 50%" />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Mary</h5>
                                            </div>
                                            <div class="ml-auto">
                                                <h5>8:58 AM</h5>
                                            </div>
                                        </div>

                                        <p class="card-text d-flex justify-content-end mt-2">
                                            SUBJECT
                                        </p>
                                        <p class="card-text d-flex justify-content-end">
                                            <small>Lorem ipsum dolor sit amet ...</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-7 col-md-7 border p-2">
                <div class="border-bottom">

                    <div class="d-flex justify-content-between">
                        <div>
                            <h3>David Sample Name &nbsp; <i class="fa-solid fa-circle text-success"></i> </h3>
                        </div>
                        <div class="ml-auto">
                            {{-- <button class="btn btn-danger btn-block" data-bs-toggle="modal"
                                data-bs-target="#create-new-conversation-modal">New Email</button> --}}
                        </div>
                    </div>
                </div>


                {{-- @include('client.inbox.includes.email_actions') --}}
                {{-- @yield('main_room_section') --}}
                <div>
                    <h5 class="p-4">SUBJECT LOREM IPSUM SUBJECT</h5>

                    <div class="p-2">
                        <div class="row p-2">
                            <div class="col-lg-2">
                                <img src="data:image/jpeg;base64,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"
                                    class="img-fluid p-2" style="border-radius: 50%" />
                            </div>
                            <div class="col-lg-9 p-2">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <h5 class="card-title">David Sample Name</h5>
                                    </div>
                                    <div class="col-lg-3">
                                        <h5 class="text-muted">8:58 AM</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit alias consectetur
                                        quos, modi, illo tempora repellat velit quibusdam animi optio natus ullam deleniti
                                        nulla. Eligendi ipsa nesciunt accusamus vel ab.
                                    </div>
                                    <div class="col-lg-9">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit alias consectetur
                                        quos, modi, illo tempora repellat velit quibusdam animi optio natus ullam deleniti
                                        nulla. Eligendi ipsa nesciunt accusamus vel ab.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-lg-2">
                                <h5 class="text-muted">8:58 AM</h5>
                            </div>
                            <div class="col-lg-9 p-2">
                                <div class="row">
                                    <div class="col-lg-9 d-flex justify-content-end">
                                        <h5 class="card-title">David Sample Name</h5>
                                    </div>
                                    <div class="col-lg-3">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit alias consectetur
                                        quos, modi, illo tempora repellat velit quibusdam animi optio natus ullam deleniti
                                        nulla. Eligendi ipsa nesciunt accusamus vel ab.
                                    </div>
                                    <div class="col-lg-9">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit alias consectetur
                                        quos, modi, illo tempora repellat velit quibusdam animi optio natus ullam deleniti
                                        nulla. Eligendi ipsa nesciunt accusamus vel ab.
                                    </div>
                                    <div class="col-lg-3">
                                        <img src="data:image/jpeg;base64,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"
                                            class="img-fluid p-2" style="border-radius: 50%" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9 p-2">
                            {{-- <textarea class="form-control"></textarea> --}}
                            <input type="text" name="" id="" class="form-control" style="height: 60px;">
                        </div>
                        <div class="col-lg-3">
                            <button class="mt-3">Send</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>



    <div style="display:none" data-labels="{{ json_encode(auth('client')->user()->labels) }}" id="user-labels-div"></div>

    <form action="{{ route('client.conversation-subs.unread') }}" method="post" id="unread-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="unread-conversation-ids">
    </form>

    <form action="{{ route('client.conversation-subs.star') }}" method="post" id="star-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="star-conversation-ids">
        <input type="hidden" name="star" id="star-txt">
    </form>

    <form action="{{ route('client.conversation-subs.important') }}" method="post" id="important-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="important-conversation-ids">
        <input type="hidden" name="important" id="important-txt">
    </form>

    <form action="{{ route('client.conversation-subs.archive') }}" method="post" id="archive-form">
        @csrf
        <input type="hidden" name="subscription_ids" id="archive-conversation-ids">
        <input type="hidden" name="archived" id="archive-txt">
    </form>

    <form action="{{ route('client.conversation-subs.delete') }}" method="post" id="delete-convo-form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="subscription_ids" id="delete-conversation-ids">
    </form>

    @include('client.conversations.includes.create_conversation_modal')
    @include('client.conversations.includes.create_conversation_modal')
    @include('client.conversations.includes.confirm_archived_modal')
    @include('client.conversations.includes.confirm_delete_modal')
    @include('client.inbox.includes.create_label_modal')
    @include('client.inbox.includes.set_labels_modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            let add_label_btn = document.querySelector('#add-label-btn');

            add_label_btn.addEventListener('click', function(e) {
                e.preventDefault;

                let myModal = new bootstrap.Modal(document.getElementById('add-label-modal'), {
                    keyboard: false
                })
                myModal.show()
            });

            const checkboxes = document.querySelectorAll(".select-sub-checkbox");
            let checkedItems = [];

            if (!checkboxes.length) {
                // Conversation show page
                let data = document.querySelector('#subscription-div').getAttribute('data-subscription');
                data = JSON.parse(data);
                checkedItems.push(data);
            } else {
                // Inbox rooms (multiple conversations)
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener("change", (e) => {
                        e.preventDefault;
                        let data = e.target.getAttribute('data-subscription');
                        data = JSON.parse(data);

                        if (e.target.checked) {
                            checkedItems.push(data);
                        } else {
                            checkedItems = checkedItems.filter(item => item.id != data.id);
                        }
                    });
                });
            }


            let unread_button = document.querySelector('.btn-unread');

            if (unread_button) {
                unread_button.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    let targetInput = document.querySelector('#unread-conversation-ids');
                    targetInput.value = checkedItems.map(item => item.id);

                    document.querySelector('#unread-form').submit();
                });
            }

            let star_button = document.querySelector('.btn-star');

            if (star_button) {
                star_button.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#star-conversation-ids').value = checkedItems.map(item => item
                        .id);
                    document.querySelector('#star-txt').value = 'true';
                    document.querySelector('#star-form').submit();
                });
            }

            let unstar_button = document.querySelector('.btn-unstar');

            if (unstar_button) {
                // console.log('here');

                unstar_button.addEventListener('click', () => {
                    // console.log('here');

                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#star-conversation-ids').value = checkedItems.map(item => item
                        .id);
                    document.querySelector('#star-txt').value = 'false';
                    document.querySelector('#star-form').submit();
                });
            }

            let important_button = document.querySelector('.btn-important');

            if (important_button) {
                important_button.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#important-conversation-ids').value = checkedItems.map(item =>
                        item.id);
                    document.querySelector('#important-txt').value = 'true';
                    document.querySelector('#important-form').submit();
                });
            }

            let unimportant_button = document.querySelector('.btn-unimportant');

            if (unimportant_button) {
                unimportant_button.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#important-conversation-ids').value = checkedItems.map(item =>
                        item.id);
                    document.querySelector('#important-txt').value = 'false';
                    document.querySelector('#important-form').submit();
                });
            }

            let archive_buttons = document.querySelector('.btn-archive');

            if (archive_buttons) {
                archive_buttons.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#archive-conversation-ids').value = checkedItems.map(item =>
                        item.id);
                    document.querySelector('#archive-txt').value = 'true';
                    document.querySelector('#archive-form').submit();
                });
            }

            let unarchive_button = document.querySelector('.btn-unarchive');

            if (unarchive_button) {
                unarchive_button.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#archive-conversation-ids').value = checkedItems.map(item =>
                        item.id);
                    document.querySelector('#archive-txt').value = 'false';
                    document.querySelector('#archive-form').submit();
                });
            }

            let delete_buttons = document.querySelector('.btn-delete');

            if (delete_buttons) {
                delete_buttons.addEventListener('click', () => {
                    if (checkedItems.length == 0)
                        return;

                    document.querySelector('#delete-conversation-ids').value = checkedItems.map(item => item
                        .id);
                    document.querySelector('#delete-convo-form').submit();
                });
            }

            let set_label_button = document.querySelector('#btn-set-label');

            set_label_button.addEventListener('click', () => {
                if (checkedItems.length == 0)
                    return;

                let myModal = new bootstrap.Modal(document.getElementById('set-labels-modal'), {
                    keyboard: false
                })
                myModal.show()

                let data = document.querySelector('#user-labels-div').getAttribute('data-labels');
                data = JSON.parse(data);

                let selectBox = document.querySelector('#label-select-box');

                selectBox.innerHTML = "";

                let userLabels = checkedItems.flatMap(item => {
                    return item.labels.map(item => item.id)
                });

                document.querySelector('#labels-conversation-ids').value = checkedItems.map(item => item
                    .id);

                // console.log(data);
                data.forEach(item => {
                    let option = document.createElement('option');
                    option.text = item.name;
                    option.value = item.id;

                    if (userLabels.length > 0 && userLabels.includes(item.id))
                        option.setAttribute('selected', true);

                    selectBox.appendChild(option);
                });
            });
        });
    </script>
@endsection
