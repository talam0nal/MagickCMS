<nav class="dynamic-rubricator" style="margin-top: 60px;">
	@foreach ($rubrics as $item)
		<div class="item" data-level="{{ $item->getLevel() }}" >
			<a href="{{ $item->url }}" style="background-image: url('')">
				{{ $item->title }} 
			</a>
			<i class="fa fa-plus">
			</i>
		</div>
	@endforeach
</nav>