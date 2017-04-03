
<div id="half">
        <div class="form-group">
            {!! Form::label('libelle','Title Project ') !!}
            {!! Form::text('libelle',null,['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('libelle_long','Project Description ') !!}
            {!! Form::textarea('libelle_long',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status Project ') !!}
            {!! Form::select('status',Status::all()->lists('name','id'),'0',['id'=>'status', 'class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('chef','Chef Project ') !!}
            {!! Form::select('chef',User::all()->lists('name','id')->toArray(),null,['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('charte','Charte : ') !!}
            {!! Form::text('charte',null,['class'=>'form-control']) !!}
        </div>
            <div class="form-group">
                {!! Form::label('direction','Direction : ') !!}
                {!! Form::text('direction',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('entreprise','Enterprise: ') !!}
                {!! Form::text('entreprise',null,['class'=>'form-control']) !!}
            </div>
</div>

<span id="other_half">
        <div class="form-group">
            {!! Form::label('continent','Continent : ') !!}
            {!! Form::text('continent',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('pays','Pays : ') !!}
            {!! Form::text('pays',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('site','Site : ') !!}
            {!! Form::text('site',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('debut','Date de debut: ') !!}
            {!! Form::input('date','debut',date('Y-m-d'),['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fin','Date de fin : ') !!}
            {!! Form::input('date','fin',date('Y-m-d'),['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('logo','Project Logo') !!}
            {!! Form::file('logo') !!}
        </div>
        <div class="form-group">
            {!! Form::label('members','Members') !!}
            {!! Form::select('members[]',$members,$team_members,['id'=>'members_list','class'=>'form-control','multiple','required']) !!}
        </div>

</span>

    <div class="form-group">
        {!! Form::submit($action_project .' Project',['class'=>'form-control btn btn-success']) !!}
    </div>