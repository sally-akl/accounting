@if ($paginator->hasPages())

<nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                          @if ($paginator->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">@lang('pagination.previous')</a>
                                            </li>
                                            @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">@lang('pagination.previous')</a>
                                            </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @foreach ($elements as $element)
                                                {{-- "Three Dots" Separator --}}
                                                @if (is_string($element))
                                                    <li class="disabled" class="page-item" aria-disabled="true"><a class="page-link" href="#">{{ $element }}</a></li>
                                                @endif

                                                {{-- Array Of Links --}}
                                                @if (is_array($element))
                                                    @foreach ($element as $page => $url)
                                                        @if ($page == $paginator->currentPage())
                                                            <li class="page-item activePagination" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            @if ($paginator->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
                                            </li>
                                              @else

                                              <li class="page-item disabled">
                                                  <a class="page-link" href="#">@lang('pagination.next')</a>
                                              </li>

                                              @endif
                                        </ul>
                                    </nav>


                                    @endif
