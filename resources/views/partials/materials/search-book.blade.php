<div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Agregar libro
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('books.save_book') }}">
                    @csrf
                    <label>{{ __('Código del libro') }}</label><br>
                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required>
                    @if (session('status'))
                        <div class="alert alert-warning">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" name="user_name" value="{{ auth()->user()->user_name }}">
                    <div class="text-center py-2">
                        <button type="submit" class="btn btnRegister btn-sm">
                            {{ __('Guardar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>