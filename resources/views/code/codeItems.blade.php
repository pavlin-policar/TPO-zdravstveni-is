                    <div class="form-group">
                        {!! Form::label('codeName', 'Ime šifranta') !!}
                        @if(isset($code))
                            {!! Form::text('codeName', $code['codeName'], ['class' => 'form-control', 'required' => 'required']) !!}
                        @else
                            {!! Form::text('codeName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('codeDescription', 'Opis šifranta') !!}
                        {!! Form::textarea('codeDescription', $code['codeDescription'], ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('minValue', 'Minimalna vrednost') !!}
                        {!! Form::number('minValue', $code['minValue'], ['class' => 'form-control','step'=>'any']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('maxValue', 'Maksimalna vrednost') !!}
                        {!! Form::number('maxValue', $code['maxValue'], ['class' => 'form-control','step'=>'any']) !!}
                    </div>

                    {{ Form::hidden('curentId', $id) }}