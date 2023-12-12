{{-- Success  --}}
@if (session()->has('success'))
    <!-- Basic toast -->
    <div class="toast toast-basic show position-fixed" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="5000" style="top: 1rem; right: 1rem; min-width: 280px; background: #dcffdc;">
        <div class="toast-header" style="color:green">
            {{-- <img src="{{ asset('app-assets/images/logo/logo.png')}}" class="mr-1" alt="Toast image" height="18"
             width="25" /> --}}
            {{-- /success svg icon  --}}
            <svg height="30" width="30" stroke="currentColor" fill="currentColor" stroke-width="0" version="1.2"
                baseProfile="tiny" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.972 6.251c-.967-.538-2.185-.188-2.72.777l-3.713 6.682-2.125-2.125c-.781-.781-2.047-.781-2.828 0-.781.781-.781 2.047 0 2.828l4 4c.378.379.888.587 1.414.587l.277-.02c.621-.087 1.166-.46 1.471-1.009l5-9c.537-.966.189-2.183-.776-2.72z">
                </path>
            </svg>
            <strong class="mr-auto">Success</strong>
            {{-- <small class="text-muted">11 mins ago</small> --}}
            <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{ session()->get('success') }}</div>
    </div>
    <!-- Basic toast ends -->
    <script>
        let toastBasic = document.querySelector('.toast-basic');
        let toastBasicClose = document.querySelector('.toast-basic .close');

        toastBasicClose.addEventListener('click', function() {
            toastBasic.classList.remove('show')
            toastBasic.classList.add('hide')
        });

        setTimeout(() => {
            toastBasic.classList.remove('show')
            toastBasic.classList.add('hide')

        }, 5000);
    </script>

    {{-- delete session after successfully desplayed  --}}
    @php
        request()->session()->forget('success');
    @endphp
@endif

{{-- error  --}}
@if (session()->has('error'))
    <!-- Basic toast -->
    <div class="toast toast-basic show position-fixed" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="5000" style="top: 1rem; right: 1rem; min-width: 280px; background: #ffdcdc;">
        <div class="toast-header" style="color:red">
            {{-- <img src="{{ asset('app-assets/images/logo/logo.png')}}" class="mr-1" alt="Toast image" height="18"
             width="25" /> --}}
            {{-- error svg icon  --}}
            <svg height="30" width="30" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 6C12.5523 6 13 6.44772 13 7V13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13V7C11 6.44772 11.4477 6 12 6Z"
                    fill="currentColor"></path>
                <path
                    d="M12 16C11.4477 16 11 16.4477 11 17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17C13 16.4477 12.5523 16 12 16Z"
                    fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12Z"
                    fill="currentColor"></path>
            </svg>

            <strong class="mr-auto">Error</strong>
            {{-- <small class="text-muted">11 mins ago</small> --}}
            <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{ session()->get('error') }}</div>
    </div>
    <!-- Basic toast ends -->
    <script>
        let toastBasic = document.querySelector('.toast-basic');
        let toastBasicClose = document.querySelector('.toast-basic .close');

        toastBasicClose.addEventListener('click', function() {
            toastBasic.classList.remove('show')
            toastBasic.classList.add('hide')
        });

        setTimeout(() => {
            toastBasic.classList.remove('show')
            toastBasic.classList.add('hide')

        }, 5000);
    </script>
    {{-- delete session after successfully desplayed  --}}
    @php
        request()->session()->forget('error');
    @endphp
@endif
