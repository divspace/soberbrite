# Functions...
fixFilePermissions() {
    find . -type f -exec chmod 644 {} \;
}

fixDirectoryPermissions() {
    find . -type d -exec chmod 755 {} \;
}

fixAllPermissions() {
    find . -type f -exec chmod 644 {} \;
    find . -type d -exec chmod 755 {} \;
}
