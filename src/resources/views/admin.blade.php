@extends('layouts.app')

@section('title')
<title>管理画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<a href="{{ route('logout.get') }}" class="header-button">logout</a>
@endsection

@section('content-title')
<p class="content-title">Admin</p>
@endsection

@section('content')
<div class="admin__content">
    <div class="search__container">
        <form action="/admin/search" class="seach-form" method="GET">
        @csrf
            <div>
                <input class="search-input-text" type="text" name="seach-text" placeholder="名前やメールアドレスを入力してください" value="{{ request()->input('seach-text') }}">
            </div>
            <div>
                <select class="search-select-gender" name="gender">
                    <option value="">性別</option>
                    <option value="" {{ request()->input('gender') == '全て' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ request()->input('gender') == '男性' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request()->input('gender') == '女性' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request()->input('gender') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div>
                <select class="search-select-content" name="inquiry_type">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}" {{ request()->input('inquiry_type') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['content'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <input class="search-input-date" type="date" name="date" value="{{ request()->input('date') }}">
            </div>
            <div>
                <button class="search-button">検索</button>
            </div>
            <div>
                <a href="/admin" class="reset-button">リセット</a>
            </div>
        </form>
    </div>

    <div class="sub__container">
        <div class="sub__item">
            <button class="export-button" id='export-button'>エクスポート</button>
            <div class="pagination">
                {{ $contacts->appends(request()->except('page'))->links() }}
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->first_name }}　{{ $contact->last_name }}</td>
                    <td>{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button 
                            class="details-button" 
                            data-contact-id="{{ $contact->id }}"
                            data-contact-name="{{ $contact->first_name }}  {{ $contact->last_name }}"
                            data-contact-gender="{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}"
                            data-contact-email="{{ $contact->email }}"
                            data-contact-tel="{{ $contact->tel }}"
                            data-contact-address="{{ $contact->address }}"
                            data-contact-building="{{ $contact->building }}"
                            data-contact-content="{{ $contact->category->content }}"
                            data-contact-detail="{{ $contact->detail }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <dialog id="modal" class="modal">
        <div class="modal-button-close">
            <button id="close" class="button-close">×</button>
        </div>
        <div class="modal-content">
            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td id="modal-name"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="modal-gender"></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="modal-email"></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td id="modal-tel"></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td id="modal-address"></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td id="modal-building"></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="modal-content"></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td id="modal-detail"></td>
                </tr>
            </table>
            @isset($contact)
                <form action="{{ route('admin.destroy', ['contactId' => $contact->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                    <div class="modal-button-delete">
                        <button id="delete-button" class="button-delete">削除</button>
                    </div>
                </form>
            @endisset
        </div>
    </dialog>
</div>

<script>
    const modal = document.getElementById('modal');
    const closeButton = document.getElementById('close');

    document.querySelectorAll('.details-button').forEach(button => {
        button.addEventListener('click', function () {
            const contactId = this.getAttribute('data-contact-id');
            const contactName = this.getAttribute('data-contact-name');
            const contactGender = this.getAttribute('data-contact-gender');
            const contactEmail = this.getAttribute('data-contact-email');
            const contactTel = this.getAttribute('data-contact-tel');
            const contactAddress = this.getAttribute('data-contact-address');
            const contactBuilding = this.getAttribute('data-contact-building');
            const contactContent = this.getAttribute('data-contact-content');
            const contactDetail = this.getAttribute('data-contact-detail');

            document.getElementById('modal-name').textContent = contactName;
            document.getElementById('modal-gender').textContent = contactGender;
            document.getElementById('modal-email').textContent = contactEmail;
            document.getElementById('modal-tel').textContent = contactTel;
            document.getElementById('modal-address').textContent = contactAddress;
            document.getElementById('modal-building').textContent = contactBuilding;
            document.getElementById('modal-content').textContent = contactContent;
            document.getElementById('modal-detail').textContent = contactDetail;

            modal.showModal();
        });
    });

    closeButton.addEventListener('click', function () {
        modal.close();
    });

    document.getElementById('export-button').addEventListener('click', function () {
        const contacts = @json($csvcontacts);
        console.log(contacts); 
        const data = [];
        const genderMapping = {1: '男性',2: '女性',3: 'その他'};

        data.push(['Id','First Name', 'Last Name','Gender', 'Email', 'Tel', 'Address','Building','Content','Detail']);

        contacts.forEach(contact => {
            const gender = genderMapping[contact.gender]
            data.push([contact.id,contact.first_name,contact.last_name,gender,contact.email,contact.tel, 
                       contact.address,contact.building,contact.category.content,contact.detail]);
        });

        const csvContent = data.map(e => e.join(",")).join("\n");
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');

        if (link.download !== undefined) {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'contacts.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });

    // document.getElementById('delete-button').addEventListener('click', function() {
    //     const contactId = this.getAttribute('data-contact-id');
    //     console.log(contactId);
    //     fetch(`/admin/${contactId}`, {
    //         method: 'DELETE',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         }
    //     })
    //     // .then(response => {
    //     //     if (response.ok) {
    //     //         location.reload();
    //     //     }
    //     // })
    //     .catch(error => console.error('削除エラー:', error));
    // });
</script>
@endsection