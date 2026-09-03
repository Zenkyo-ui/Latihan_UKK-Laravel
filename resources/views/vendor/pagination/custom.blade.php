<?php
// Pagination sederhana (default Laravel jika framework tidak diset).
$page = $paginator->currentPage();
$last = $paginator->lastPage();
?>
@if ($last > 1)
    <nav style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <span style="color:var(--text-muted); font-size:0.85rem;">
            Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}
        </span>
        <ul style="display:flex; gap:6px; list-style:none; margin:0; padding:0;">
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" style="{{ $paginator->onFirstPage() ? 'pointer-events:none; opacity:.4;' : '' }} padding:6px 12px; border-radius:8px; border:1px solid var(--border-input); color:var(--text); text-decoration:none; font-size:0.85rem;">&laquo;</a>
            </li>
            @for ($i = 1; $i <= $last; $i++)
                <li>
                    @if ($i == $page)
                        <span style="padding:6px 12px; border-radius:8px; background:var(--primary); color:#0a0a08; font-weight:700; font-size:0.85rem;">{{ $i }}</span>
                    @else
                        <a href="{{ $paginator->url($i) }}" style="padding:6px 12px; border-radius:8px; border:1px solid var(--border-input); color:var(--text); text-decoration:none; font-size:0.85rem;">{{ $i }}</a>
                    @endif
                </li>
            @endfor
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" style="{{ $paginator->hasMorePages() ? '' : 'pointer-events:none; opacity:.4;' }} padding:6px 12px; border-radius:8px; border:1px solid var(--border-input); color:var(--text); text-decoration:none; font-size:0.85rem;">&raquo;</a>
            </li>
        </ul>
    </nav>
@endif