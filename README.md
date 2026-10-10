# Nginx Webhost Egg

A Pterodactyl egg for hosting PHP and static websites with **nginx 1.30** and
**PHP 8.3 / 8.4 / 8.5**.

- **Composer**: put packages in *Composer modules* (space separated). Each one is added once
  and kept at that version; on every start `composer install` keeps `vendor/` in line with
  `composer.lock`
- **WordPress**: turn on *Wordpress* when creating the server
- **Git**: set *Git Repo Address* to clone your site; *Auto Update* pulls on every start
- **Site variables**: SMTP / mail, site name and URL, Discord and Google OAuth and the
  database connection string are passed to PHP, so your code reads them with `getenv('SMTP_HOST')`
  etc. instead of hardcoding them
- **Update check**: the console says when the egg or the Docker image has an update

## Install

1. Download [`egg-nginx-webhost.json`](https://github.com/Mkkbeydoun/pterodactyl-nginx-egg/releases/latest/download/egg-nginx-webhost.json)
   from the [latest release](https://github.com/Mkkbeydoun/pterodactyl-nginx-egg/releases/latest).
2. In the panel: **Admin → Nests → Import Egg**, upload it.
3. Create a server with the egg, pick a PHP version (Docker Image), and visit `http://ip:port`.

## Files on your server

| Path | What it's for |
|------|---------------|
| `webroot/` | Your website. Upload your files here (`index.html` or `index.php`) |
| `php-fpm/php.ini` | PHP settings: memory limit, upload size, ... Restart to apply |
| `nginx/conf.d/default.conf` | The site's nginx config |
| `logs/` | nginx and PHP logs. Any log over 10 MB is moved to `*.log.1` |
| `start.sh` | Startup script |

**Reinstalling** a server replaces `nginx/`, `php-fpm/` and `start.sh` with fresh copies
(back up your edits to them first), pulls the Git repo if one is set, and installs WordPress
only into an empty `webroot/`. Your other website files are kept.

## Updates

Every time a server starts it checks for updates in the background and says in the console if:

- **the egg has an update**: download `egg-nginx-webhost.json` from the
  [latest release](https://github.com/Mkkbeydoun/pterodactyl-nginx-egg/releases/latest), then
  **Admin → Nests → (nest) → Nginx Webhost → Update Egg** with it (not *Import Egg*, that
  makes a second copy), and **Reinstall** the server.
- **the Docker image has an update**: restart the server, the panel downloads the latest
  image on every start. If it keeps showing, run
  `docker pull ghcr.io/mkkbeydoun/pterodactyl-nginx-egg:php8.x` on the node to see why.
- **the server's PHP version is no longer offered**, or the server isn't using one of this
  egg's images: **Admin → Servers → server → Startup → Docker Image**, pick one of the
  egg's images.

Turn it off per server with the *Update Check* variable.

## License

MIT, see [LICENSE.md](LICENSE.md). Based on the WebHost egg by Sigma Productions, originally
[tenten8401/pterodactyl-nginx](https://gitlab.com/tenten8401/pterodactyl-nginx), with Git
install logic from [parkervcp/eggs](https://github.com/parkervcp/eggs); see
[NOTICE.md](NOTICE.md) for credits and their licenses.
