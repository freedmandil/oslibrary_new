@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <!-- Dashboard Title -->
        <div class="row mb-4">

        </div>

        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Seforim
                            </a>
                        </li>
                        <!-- Add more links for other entities like Authors, Publishers -->
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Books Subtitle -->
                <div class="row mb-3">
                    <div class="col">
                        <h2>Seforim</h2>
                    </div>
                </div>
                <div class="form-group">
                    <label for="shelf_number">Shelf Number:</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control shelf_number" id="shelf_number_text" name="shelf_number_text" placeholder="Enter Shelf Number">
                        </div>
                        <div class="col">
                            <select class="form-control shelf_number" id="shelf_number_dropdown" name="shelf_number">
                                <option value="">Select Shelf Number</option>
                                @foreach($shelfnumbers as $id => $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Books Table -->
                <script>const userLanguage = 'en'; /*{{$user->sys_language->lan_code}}'*/
                </script>
                <script src="{{ mix('/js/grid-books.js') }}"></script>
                <script>
                    const rowData = ""; @php
//                       $output = $books->map(function($book) use ($user) { // Use 'use ($user)' to pass the $user variable into the closure
//                        return [
//                            'id' => $book->id,
//                            'title' => $book->lib_title->book_title,
//                            'author' => $book->lib_author->first() ? $book->lib_author->first()->first_name . ' ' . $book->lib_author->first()->last_name : null,
//                            'shelfname' => $book->loc_shelfname->name,
//                            'sefer_number' => $book->sefer_number,
//                            'book_edition' => $book->book_edition,
//                            'publisher' => ($book->sys_language->lan_code == 'he') ? $book->lib_publisher->name_he : $book->lib_publisher->name_en,
//                            'book_type' => $book->book_type,
//                            'topic' => $book_lan == 'he' ? $book->tax_topic->name_he : $book->tax_topic->name_en,
//                            'class_ref' => $book->book_class_ref,
//                            'class_number' => $book->book_class_number,
//                            'reference_id' => $book->book_reference_id,
//                            'language' => $book->sys_language->name_lan,
//                            'barcode' => $book->barcode,
//                            'location' => $book->sys_language->lan_code == 'he' ? $book->loc_assignment->loc_location->name_he : $book->loc_assignment->loc_location->name_en,
//                            'date_updated' => $book->date_updated,
//                            'edit_permission' => $user->access_level >= 5,
//                            'delete_permission' => $user->access_level >= 7,
//                        ];
//                    })->toArray();

                    @endphp;


                </script>
                <div id="Books_Grid"></div>
{{--                <div class="table-responsive">--}}
{{--                    <table class="table @php echo ($user->sys_language->lan_code == 'he') ? 'rtl' : 'ltr'; @endphp " id="libBooks_Table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            @if($user->sys_language->lan_code == 'en')--}}
{{--                                <th scope="col">&nbsp;</th>--}}
{{--                                <th scope="col">Title</th>--}}
{{--                                <th scope="col">Author</th>--}}
{{--                                <th scope="col">Shelf Number</th>--}}
{{--                                <th scope="col">Sefer Number</th>--}}
{{--                                <th scope="col">Edition</th>--}}
{{--                                <th scope="col">Publisher</th>--}}
{{--                                <th scope="col">Type</th>--}}
{{--                                <th scope="col">Topic</th>--}}
{{--                                <th scope="col">Class Ref</th>--}}
{{--                                <th scope="col">Class Number</th>--}}
{{--                                <th scope="col">Reference ID</th>--}}
{{--                                <th scope="col">Language</th>--}}
{{--                                <th scope="col">Barcode</th>--}}
{{--                                <th scope="col">Assignment</th>--}}
{{--                                <th scope="col">Date Updated</th>--}}
{{--                                <th scope="col" >&nbsp;</th>--}}
{{--                            @else--}}
{{--                                <th class="text-center" scope="col">&nbsp;</th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">שם</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מחבר</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מספר תא</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מספר ספר</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מדורה</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מוצי לאור</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">סוג</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">נושא</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">אות נושא</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מספר נושא</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מספר כללי</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">שפה</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">ברכוד</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">מקום</span></th>--}}
{{--                                <th class="text-center" scope="col"><span class="rtl">תאריך שינוי</span></th>--}}
{{--                                <th class="text-center" scope="col" ><span class="rtl">&nbsp;</span></th>--}}
{{--                            @endif--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($books as $book)--}}
{{--                            @php--}}
{{--                                $book_lan = $book->sys_language->lan_code;--}}
{{--                                $firstAuthor = $book->lib_author->first();--}}
{{--                            @endphp--}}
{{--                            <tr>--}}
{{--                                <th scope="row"><span class="text-light">{{ $book->id }}</span></th>--}}
{{--                                <td class="text-center"><span class="{{($book_lan == 'he') ? 'rtl' : 'ltr' }}" >{{ $book->lib_title->book_title }}</span></td>--}}
{{--                                <td class="text-center"><span class="{{($book_lan == 'he') ? 'rtl' : 'ltr' }}" >@if($firstAuthor){{ $firstAuthor->first_name }} {{ $firstAuthor->last_name }}@endif</span></td>--}}
{{--                                <td class="text-center">{{ $book->loc_shelfname->name }}</td>--}}
{{--                                <td class="text-center">{{ $book->sefer_number }}</td>--}}
{{--                                <td class="text-center">{{ $book->book_edition }}</td>--}}
{{--                                <td class="text-center">{{ $book->lib_publisher->name_en }}</td>--}}
{{--                                <td class="text-center">{{ $book->book_type }}</td>--}}
{{--                                <td class="text-center"><span class="{{($book_lan == 'he') ? 'rtl' : 'ltr' }}" >{{ $book_lan == 'he' ? $book->tax_topic->name_he : $book->tax_topic->name_en }}</span></td>--}}
{{--                                <td class="text-center">{{ $book->book_class_ref }}</td>--}}
{{--                                <td class="text-center">{{ $book->book_class_number }}</td>--}}
{{--                                <td class="text-center">{{ $book->book_reference_id }}</td>--}}
{{--                                <td class="text-center">{{ $book->sys_language->name_lan }}</td>--}}
{{--                                <td class="text-center">{{ $book->barcode }}</td>--}}
{{--                                <td class="text-center"><span class="p-2 {{($book_lan == 'he') ? 'rtl' : 'ltr' }} sys_{{ $book->loc_assignment->sys_color->color_name }}">{{ $book_lan == 'he' ? $book->loc_assignment->loc_location->name_he : $book->loc_assignment->loc_location->name_en }}</span></td>--}}
{{--                                <td>{{ $book->date_updated }}</td>--}}
{{--                                <td colspan="4">--}}
{{--                                    @if ($user->access_level >= 5)<a href="#" class="btn btn-primary">Edit</a>@endif--}}
{{--                                    @if ($user->access_level >= 7)<a href="#" class="btn btn-danger">Delete</a>@endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
            </main>
        </div>
    </div>

@endsection
