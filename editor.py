#!/bin/python3

import sys
import os

ABS_FILE_PATH=sys.argv[1:][0].strip()
edit_count=0

with open(ABS_FILE_PATH) as p_file:
  with open(ABS_FILE_PATH + "_edited", "w") as c_file:
    for line in p_file:
      for setting in sys.argv[2:]:
        f_chunks = line.strip().split("=")
        s_chunks = setting.strip().split("=")
        if (len(f_chunks)>0) & (len(s_chunks)>0) & (f_chunks[0] == s_chunks[0]):
          line = setting
          edit_count+=1
          break
      c_file.write(line.strip() + "\n")

os.system(f"mv {ABS_FILE_PATH}_edited {ABS_FILE_PATH}")
