#!/usr/bin/env python3

# Usage:
# ./utils/dir-tree.sh assets/images
# ./utils/dir-tree.sh patterns
# ./utils/dir-tree.sh parts

import os
import sys

target_dir = sys.argv[1] if len(sys.argv) > 1 else '.'
target_dir = target_dir.rstrip('/')

def tree(dir_path, prefix=''):
    if not os.path.exists(dir_path):
        print(f"Error: Directory '{dir_path}' not found.")
        return
    items = sorted([f for f in os.listdir(dir_path) if not f.startswith('.')])
    for i, item in enumerate(items):
        is_last = (i == len(items) - 1)
        connector = '└── ' if is_last else '├── '
        print(prefix + connector + item)
        path = os.path.join(dir_path, item)
        if os.path.isdir(path):
            tree(path, prefix + ('    ' if is_last else '│   '))

print(f"{target_dir}/")
tree(target_dir)