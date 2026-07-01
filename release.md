# Publishing to the WordPress.org plugin directory

1. Submit for review
   - Sign in at https://wordpress.org/plugins/developers/add/ and upload a zip
     of the plugin (the artifact produced by `npm run build` + packaging, e.g.
     the zip from the GitHub Actions "Build & Publish" workflow).
   - A reviewer replies by email (usually days to a couple of weeks). Address
     any requested changes and reply to the same thread.

1. Get your SVN repository
   - On approval you receive push access to
     `https://plugins.svn.wordpress.org/pfadiheime/` with this layout:
       trunk/   — current development version
       tags/    — one subfolder per released version (e.g. tags/1.0.0)
       assets/  — icon, banner and screenshots (not shipped to users)

1. Publish a release
   - Check out the repo: `svn co https://plugins.svn.wordpress.org/pfadiheime/`
   - Copy the built plugin (pfadiheime.php, includes/, build/, readme.txt — the
     same files the release zip contains) into `trunk/`.
   - Set "Stable tag" in readme.txt to the version being released.
   - `svn add --force trunk/*`, then tag it:
     `svn cp trunk tags/1.0.0`
   - Commit: `svn ci -m "Release 1.0.0"`. The directory serves the version named
     by "Stable tag".

1. Store display assets in `assets/` (committed the same way):
   - `icon-256x256.png`, `banner-772x250.png`, `screenshot-1.png`, etc.
