# CLAUDE.md

Official website of KONI Provinsi Papua Pegunungan. Laravel 12 (PHP 8.2+), Tailwind CSS 4 (via `@tailwindcss/vite`), Alpine.js 3, Vite 7, Font Awesome 7. All UI text, route names, models, columns and code comments are in **Bahasa Indonesia**. Keep new code consistent with that.

## Commands

```bash
composer setup                 # first install: deps, key, migrate, npm install, build
composer dev                   # serve + queue + pail logs + vite, all at once
php artisan migrate:fresh --seed
php artisan storage:link       # required: uploads are served from storage/app/public
npm run build                  # production assets -> public/build (gitignored)
composer test                  # PHPUnit (only the example tests exist)
php artisan view:cache         # quick way to catch Blade syntax errors
```

Local `.env` uses SQLite. Production uses MySQL. Write queries that work on both. For example, a `date` cast on SQLite stores `Y-m-d 00:00:00`, so don't match it against a plain `Y-m-d` string.

`public/build.zip` is committed on purpose. It is a prebuilt asset bundle for hosting that has no Node. Rebuild and replace it only when asked.

## Architecture

- **Three areas, one route file** (`routes/web.php`):
  - Public visitor pages: `VisitorController`, wrapped in the `track.visitor` middleware.
  - `/admin/*`: role `admin_master` (site settings, users, login log, DB backup/restore, visitor stats).
  - `/penulis/*`: role `penulis` (CRUD for berita, kategori berita, kegiatan, cabang olahraga, galeri, media).
- **Custom auth middleware.** Laravel's built-in `auth` is not used. The aliases are defined in `bootstrap/app.php`: `auth.custom`, `guest.custom`, `role:<name>`, `track.visitor`.
- **Site settings.** `PengaturanSitus` is a key/value table. `App\View\Composers\SitusComposer` (registered in `AppServiceProvider`) shares it with layouts, partials and all `visitor.*`, `admin.*`, `penulis.*` and `errors.*` views as `$situs` (array: `nama_situs`, `deskripsi_situs`, `logo`, `alamat`, `telepon`, `email`, `sosmed_*`, `seo_*`). Always read it with a fallback: `$situs['x'] ?? '...'`.
- **Soft deletes + restore** on most content models. Penulis/admin index pages share `resources/views/partials/crud-index.blade.php`.
- **Berita images**: use the `$berita->gambar` accessor. It resolves `gambar_url` (an external http URL or a storage path) and attached media. Don't build the URL by hand.
- **Rich text**: berita content comes from CKEditor 5 (CDN, in the penulis form). Render it with `{!! !!}` inside a `.prose` wrapper. The `.prose` and `.ck-content` styles live in `resources/css/app.css`.

## Views

- Layouts: `layouts/visitor.blade.php` (SEO/OG meta via `@section('seo-title' | 'seo-description' | 'seo-image' | 'og-type')`) and `layouts/dashboard.blade.php`.
- Partials: `header`, `footer` (logo badge overlapping the footer's top border, then 3 columns: Navigasi / Link Terkait / Hubungi Kami), `page-banner` (used on every inner visitor page).
- Alpine components are registered in `resources/js/app.js` (`Alpine.data(...)`). Page-specific ones can be inline.
- `_backup/html_design/` holds the original static HTML mockups. It is reference only, so don't edit it or wire it up.

## UI conventions

- Theme tokens are defined in `resources/css/app.css` `@theme`: `primary` #C8102E (red), `secondary`, `accent` #F1F5F9, `dark` #1A1A1A. Use `bg-primary`, `text-dark`, etc., never raw hex values in Blade.
- The design is square-cornered (the `.no-round` helper). Avoid `rounded-*`. The footer logo badge is square too.
- Section rhythm: `<section class="py-20 bg-white|bg-accent">` + `container mx-auto px-4`. Section headings use a small red uppercase kicker above an `font-extrabold` title.
- Post cover images use a uniform `aspect-video object-cover` everywhere (beranda list, berita grid, detail, sidebar thumbnails).
- Long body text on detail pages is `text-justify`.
- Homepage (`visitor/beranda.blade.php`): a half-height hero (≥50vh) with a short "about" summary on the left and an image on the right, so the latest news shows above the fold. The "Pencapaian Sejarah PON XXI" block is kept in a Blade comment (hidden). Uncomment it to restore.
